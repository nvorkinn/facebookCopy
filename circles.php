<!DOCTYPE HTML>
<html>

<head>

	<?PHP 
        
	require("includes/php-includes.php");
	require("includes/html-includes.php"); 
            
	if(!isset($_SESSION["user_id"])){
		header("location: index.php");
	}
	$user_id = $_SESSION["user_id"];
            
	
            
            
	if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = $user_id) LIMIT 1"))
	{
		$profile = $result->fetch_object();
	}
            
	?>

	<link href="css/circles.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/circles.js"></script>
</head>


<body class="skin-blue">
 
	<?PHP
	require("includes/header.php"); 
	?>    
        
	<div class="wrapper row-offcanvas row-offcanvas-left">
        
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="left-side sidebar-offcanvas">           
            
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
                
				<!-- Sidebar user panel -->
				<div class="user-panel">
                    
					<div class="pull-left image">
						<img src="img/avatar3.png" class="img-circle" alt="User Image" />
					</div>
                        
					<div class="pull-left info">
						<p><?PHP
                            
							if (isset($profile)) {
								echo $profile->name . " " . $profile->surname;
							}
                            
							?></p>
						</div>
                        
					</div>
                    
					<!-- sidebar menu: : style can be found in sidebar.less -->
					<ul class="sidebar-menu">
                    
						<li>
							<a href="wall.php">
								<i class="fa"></i> <span>Wall</span>
							</a>
						</li>
                        
						<li>
							<a href="messages.php">
								<i class="fa"></i> <span>Messages</span>
							</a>
						</li>
                        
						<li class="active">
							<a href="circles.php">
								<i class="fa"></i> <span>Circles</span>
							</a>
						</li>
                        
						<li>
							<a href="profile.php">
								<i class="fa"></i> <span>Profile</span>
							</a>
						</li>
					</ul>
                    
				</section>
				<!-- /.sidebar -->
                
			</aside>

			<!-- Right side column. Contains the navbar and content of the page -->
			<aside class="right-side">

				<!-- Main content -->
				<section class="content">
					<div id="main_portion">
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<h3 class="panel-title pull-left" style="padding-top: 7.5px;">Friends</h3>
								<div class="col-sm-3 col-md-3 pull-right">
									<input type="search" class="form-control" placeholder="Search" id='search' />
									<span class="glyphicon glyphicon-search"></span>
								</div>
							</div>
							<div class="panel-body" id="friends-panel">
								<ul id="friends">
								<!-- Initiate members -->
								<?PHP
								$friend_query = "SELECT DISTINCT hash, name, surname 
									FROM user, profile
								WHERE user.profile_id = profile.id
								AND user.id
								IN (
									SELECT 
									CASE WHEN  from_user_id = $user_id
									THEN  to_user_id 
									ELSE  from_user_id 
									END 
									FROM activity, relationship
									WHERE relationship.activity_id = activity.id
									AND (
										from_user_id = $user_id
										OR to_user_id = $user_id
									)
								)";
								
								$friends = array();
								if ($friend_result = $mysqli->query($friend_query)) {
									while ($row = $friend_result->fetch_assoc()) {
										$friends[] = array("hash" => $row["hash"], "name" => $row["name"], "surname" => $row["surname"]);
									}
								}
								if($friends) {
									foreach($friends as $friend) {
										extract($friend);
										echo "<li class='friend' id='$hash' data-id='$hash'>";
										echo "<div class='thumbnail text-center'>";
										echo "<img class='img' src='img/user.jpg' id='img$hash' draggable='false'>";
										echo "<div class='caption'><strong>".ucwords($name." ".$surname)."</strong></div>";
										echo "</div>";
										echo "</li>";
									}
								}
								else {
									echo "Oops! it looks like you don't have any friends yet...";
								}
								?>
								</ul>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading clearfix">
								<h3 class="panel-title pull-left" style="padding-top: 7.5px;">Circles</h3>
								<div class="col-sm-3 col-md-3 pull-right">
									<form class="form">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Circle Name" id="new_circle_name">
											<div class="input-group-btn">
												<button class="btn btn-primary" type="submit" id="new-circle">Add Circle</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="panel-body">
								<ul id="circles">
								<!-- Initiate Circles -->
								<?PHP
								$circle_query = "SELECT id, name FROM circle WHERE owner_user_id = $user_id";
								$circles = array();
								if ($circle_result = $mysqli->query($circle_query)) {
									while ($row = $circle_result->fetch_assoc()) {
										$circles[] = array("circle_id" => $row["id"], "circle_name" => $row["name"]);
									}
								}
								if ($circles) {
									foreach ($circles as $circle) {
										extract($circle);
										$member_query = "SELECT hash, name, surname FROM user, profile, user_circle WHERE user_circle.circle_id = $circle_id AND user.id = user_circle.user_id AND user.profile_id = profile.id";
										if ($member_result = $mysqli->query($member_query)) {
											echo "<li class='outer-circle' id='$circle_id' data-placement='above' title='Circle Members'>";
											echo "<div class='hidden' style='display:none;'>";
											echo "<div class='hidden-content' id='$circle_id'>";
											echo "<ul class='list-group'>";
											$member_no = 0;
											while ($row = $member_result->fetch_assoc()) {
												$member_no++;
												extract($row);
												echo "<li class='list-group-item list-group-item-info friend' id='$hash'>";
												echo ucwords($name." ".$surname);
												echo "<button type='button' class='close delete-user' aria-hidden='true'>&times;</button>";
												echo "</li>";
											}
											echo "</ul>";
											echo "<div class='btn-group btn-group-justified'>";
											echo "<div class='btn-group'>";
											echo "<button class='btn btn-primary rename-circle' type='button'>Rename</button>";
											echo "</div>";
											echo "<div class='btn-group'>";
											echo "<button class='btn btn-danger delete-circle' type='button'>Delete</button>";
											echo "</div>";
											echo "</div>";
						                    echo "<div class='input-group' style='display:none'>";
											echo "<input type='text' class='form-control rename-name' placeholder='New circle name...'>";
											echo "<span class='input-group-btn'>";
											echo "<button class='btn btn-default rename-button' type='button'>";
											echo "Rename";
											echo "</button></span></div>";
											echo "</div>";
											echo "</div>";
											echo "<div class='circle'><div class='circle-label'>";
											echo "<div class='member-no'>".$member_no."</div><br>";
											echo "<span class='circle-name'>".$circle_name."</span></div></div>";
											echo "</li>";
										}
									}
								}
								?>
							</div>
						</div>
					</div>

				</section><!-- /.content -->
			</aside><!-- /.right-side -->
            
		</div><!-- ./wrapper -->
		
	</body>


	</html>

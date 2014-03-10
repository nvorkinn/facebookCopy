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
	<script type="text/javascript" src="js/plugins/shapeshift/core/jquery.shapeshift.js"></script>
	<style>
	.container {
		position: relative;
		width: 100%;
	}

	.container > div {
		height: 140px;
		position: absolute;
		width: 130px;
		padding: 15px;
		border: 1px dashed #ccc;
		border-radius: 5px;
	}
	
	.container > div[data-ss-colspan='2'] { width: 170px; }

	.container .ss-placeholder-child {
		background: transparent;
		border: 1px dashed red;
	}
	
	.friends-container {
		position: relative;
		width: 100%;
	}

	.friends-container > div {
		height: 140px;
		position: absolute;
		width: 130px;
		padding: 15px;
		border: 1px dashed #ccc;
		border-radius: 5px;
	}
	
	.friends-container > div[data-ss-colspan='2'] { width: 170px; }

	.friends-container .ss-placeholder-child {
		background: transparent;
		border: 1px dashed red;
	}
	</style>

	<script type="text/javascript" >

	$(document).ready(function() {
	
		$(".container").shapeshift({animateOnInit:true, colWidth:130});
		$(".friends-container").shapeshift({animateOnInit:true, dragClone:true, enableCrossDrop:false});
		
		$(".circle").on("ss-added", function(e, selected) {
			var userHash = $(selected).attr("id");
			if ($(this).children("#"+userHash).length > 1) {
				$(selected).remove();
				$(".container").trigger("ss-rearrange");
			}
			else {
				$.ajax({
					type: "post",
					url: "tools/protected/circle_utils.php",
					data: {"action":"add_to_circle", "circle_id":$(this).attr("id"), "member_to_add":userHash},
					success: function (response) {
						if(response==-1) {
							alert("Could not add member to circle!");
							alert(response);
						}
					}
				});
			}
		});
		
		$(".circle").on("ss-removed", function(e, selected) {
			var circleId = $(this).attr("id");
			var userHash = $(selected).attr("id");
			deleteUserFromCircle(circleId, userHash);
		});
	
		$("#new_circle").click(function(e){
			var circleName = $("#new_circle_name").val();
			$.ajax({
				type: "post",
				url: "tools/protected/circle_utils.php",
				data: {"action":"create_circle", "circle_name":circleName},
				success: function (response) {
					if (response == -1) {
						alert("Could not create new circle!");
					}
					else {
						var newCircle = $("<div class='panel panel-primary' style='display:none;'><div class='panel-heading'>"+circleName+"<button type='button' class='close delete-circle' aria-hidden='true'>&times;</button></div><div class='panel-body container circle' id="+response+"></div></div>");
						newCircle.appendTo("#circles");
						$(".container").trigger("ss-rearrange");
						newCircle.slideDown("slow");
					}
				}
			});
		});
	
		$(".delete-circle").click(function(e) {
			var parentPanel = $(this).parent().parent();
			var circle = parentPanel.find(".circle").eq(0);
			var circleId = circle.attr("id");
			$.ajax({
				type: "post",
				url: "tools/protected/circle_utils.php",
				data: {"action":"delete_circle", "circle_id":circleId}
			});
			parentPanel.hide("slow", function() {parentPanel.remove();});
		});
		
		$("#search").on("input", function(ev) {
			ev.preventDefault();
			var regex = new RegExp($(this).val(), "i");
			$("#friends").find(".friend").each(function() {
				if ($(this).find("b").first().text().search(regex) < 0) {
					$(this).hide();
				}
				else {
					$(this).show();
				}
			});
			$(".friends-container").trigger("ss-rearrange");
		});
		
		$("#reset").click(function() {
			$("#search").val("");
		});
	});

	function deleteUserFromCircle(circleId, userHash) {
		$.ajax({
			type: "post",
			url: "tools/protected/circle_utils.php",
			data: {"action":"delete_user_from_circle", "circle_id":circleId, "member_to_delete":userHash}
		});
	}
	</script>
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
									<form class="form" role="search">
										<div class="input-group">
											<input type="search" class="form-control" placeholder="Search" id="search">
											<div class="input-group-btn" id="reset">
												<button class="btn btn-default" type="submit">
													<i class="glyphicon glyphicon-remove"></i>
												</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="panel-body friends-container" id="friends">
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
										echo "<div class='friend text-center' id='$hash'>";
										echo "<img class='img' src='img/user.jpg' id='img$hash' draggable='false'>";
										echo "<div class='caption'><b>".ucwords($name." ".$surname)."</b></div>";
										echo "</div>";
									}
								}
								else {
									echo "Oops! it looks like you don't have any friends yet...";
								}
								?>
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
												<button class="btn btn-primary" type="submit" id="new_circle">Add Circle</button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="panel-body" id="circles">
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
										echo "<div class='panel panel-primary'>";
										echo "<div class='panel-heading'>";
										echo $circle_name;
										echo "<button type='button' class='close delete-circle' aria-hidden='true'>&times;</button>";
										echo "</div><div class='panel-body container circle' id='$circle_id'>";
										$member_query = "SELECT hash, name, surname FROM user, profile, user_circle WHERE user_circle.circle_id = $circle_id AND user.id = user_circle.user_id AND user.profile_id = profile.id";
										if ($member_result = $mysqli->query($member_query)) {
											while ($row = $member_result->fetch_assoc()) {
												extract($row);
												echo "<div class='text-center' id='$hash'>";
												echo "<img class='img' src='img/user.jpg' id='img$hash' draggable='false'>";
												echo "<div class='caption'><b>".ucwords($name." ".$surname)."</b></div>";
												echo "</div>";
											}
										}
										echo "</div>"; //Panel body
										echo "</div>"; //Panel
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

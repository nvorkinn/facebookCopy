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

	<style>
	
	#friends {
		list-style-type: none;
		margin: 0;
		padding: 0;
		width: 450px;
	}
	
	#friends li {
		margin: 3px 3px 3px 0;
		padding: 1px;
		float: left;
		width: 150px;
		height: 140px;
		text-align: center;
	}
	
	.thumbnail {
		width: 100%;
		height: 100%;
	}
	
	.thumbnail .caption {
		padding: 5px;
	}
	
	#circles {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}
	
	.outer-circle {
		margin: 10px 10px 10px 0;
		border-radius:100px;
		-moz-border-radius:100px;
		-webkit-border-radius:100px;
		background: #ececec;
		width: 125px;
		height: 125px;
		border:1px solid #b8b8b8;
		text-align: center;
		position: relative;
		float: left;
	}
	
	.circle {
		border-radius:100px;
		-moz-border-radius:100px;
		-webkit-border-radius:100px;
		margin:auto;
		margin-top: 11.5px;
		background: #428bca;
		width: 100px;
		height: 100px;
		border: 1px solid #35719b;
		-moz-box-shadow: inset -1px 1px -1px #3f87b9;
		-webkit-box-shadow: inset -1px 1px -1px #3f87b9;
		box-shadow: inset -1px 1px -1px #3f87b9;
		line-height: 200px;
	    color:#eee;
	    text-align:center;
	}
	
	.circle-label {
		font: 13px arial;
		margin: 0 auto;
		display: table-cell;
		vertical-align: middle;
		width: 100px;
		height: 100px;
		text-align: center;
		color: #fff;
 
	}
	
	.circle-label .member-no {
		font-size: 20px;
	}
	
	.circle-label-rotate {
		-webkit-animation-name: spin;
		-moz-animation-name: spin;
		-ms-animation-name: spin;
		-o-animation-name: spin;
		animation-name: spin;
		
		-webkit-animation-duration: 2s;
		-moz-animation-duration: 2s;
		-ms-animation-duration: 2s;
		-o-animation-duration: 2s;
		animation-duration: 2s;
  
		-webkit-animation-iteration-count: infinite;
		-moz-animation-iteration-count: infinite;
		-ms-animation-iteration-count: infinite;
		-o-animation-iteration-count: infinite;
		animation-iteration-count: infinite;
		
		
		-webkit-animation-timing-function:ease-in;
		-moz-animation-timing-function:ease-in;
		-ms-animation-timing-function:ease-in;
		-o-animation-timing-function:ease-in;
		animation-timing-function:ease-in;
	}
	
	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@-moz-keyframes spin {
	  0% { -moz-transform: rotate(0deg); }
	  100% { -moz-transform: rotate(360deg); }
	}

	@-ms-keyframes spin {
	  0% { -ms-transform: rotate(0deg); }
	  100% { -ms-transform: rotate(360deg); }
	}

	@-o-keyframes spin {
	  0% { -o-transform: rotate(0deg); }
	  100% { -o-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}  
	
	.popover {
		width: 300px;
	}
	
	.circle-buttons {
		padding: 0 0 0 0;
	}
	
	.form-control {
	  padding-right: 30px;
	}

	.form-control + .glyphicon {
	  position: absolute;
	  right: 0;
	  padding: 8px 40px;
	}
	
	</style>

	<script type="text/javascript">

	$(function() {
		
		$(".friend").draggable({
			helper: "clone",
			stack: ".friend",
			revert: function(droppable) {
				// Revert if not dropped in droppable area
				if (!droppable) {
					return true;
				}
				// Revert if friend is already in circle
				else if (droppable.find("li#" + $(this).attr("id")).length > 0) {
					return true;
				}
				else {
					return false;
				}
			}
		});
		
		$(".outer-circle").droppable();
		
		$("body").on("drop", ".outer-circle", function(event, ui) {
			var circle = $(this);
			$.ajax({
				type: "post",
				url: "tools/protected/circle_utils.php",
				data: {"action":"add_to_circle", "circle_id":circle.attr("id"), "member_to_add":$(ui.draggable).attr("id")},
				success: function (response) {
					if (response == 1) {
						var list = circle.find("ul.list-group");
						var userHash = $(ui.draggable).attr("id");
						var userName = $(ui.draggable).text();
						circle.find(".member-no").fadeOut(200, function() {
							$(this).text(parseInt(circle.find(".member-no").text()) + 1);
							$(this).fadeIn(200);
						});
						list.append("<li class='list-group-item friend' id='"+userHash+"'>"+userName+"<button type='button' class='close delete-user' aria-hidden='true'>&times;</button></li>");
					}
					else {
						alert("Could not add member to circle!");
						alert(response);
					}
						
				}
			});
		});
		
		$("#circles").popover({
			html: true,
			placement: "top",
			selector: ".outer-circle",
			content: function() {
				return $(this).children(".hidden").html();
			}
		});	
	
		$("#new-circle").click(function(e){
			e.preventDefault();
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
						$("<li style='display: none;' class='outer-circle' id="+response+" data-placement='above' title='Circle Members'><div class='hidden' style='display:none;'><div class='hidden-content' id="+response+"><ul class='list-group'></ul><div class='btn-group btn-group-justified'><div class='btn-group'><button class='btn btn-primary rename-circle' type='button'>Rename</button></div><div class='btn-group'><button class='btn btn-danger delete-circle' type='button'>Delete</button></div></div><div class='input-group' style='display:none'><input type='text' class='form-control rename-name' placeholder='New circle name...'><span class='input-group-btn'><button class='btn btn-default rename-button' type='button'>Rename</button></span></div></div></div><div class='circle'><div class='circle-label'><div class='member-no'>0</div><br>"+circleName+"</div></div></li>").appendTo($("#circles")).show("slide", {direction: "left"}, 600);
						$(".outer-circle").droppable();
					}
				}
			});
		});

		$("body").on("click", ".delete-circle", function() {
			$(this).closest(".popover").toggle().remove();
			var circleId = $(this).closest("div.hidden-content").attr("id");
			$.ajax({
				type: "post",
				url: "tools/protected/circle_utils.php",
				data: {"action":"delete_circle", "circle_id":circleId}
			});
			var circle = $("body").find("li.outer-circle#"+circleId);
			circle.find(".circle-label").addClass("circle-label-rotate");
			circle.animate({"bottom":"50px"},200).animate({"bottom":"0px"}, 150, function(){
				circle.animate({"opacity":"0","left":"510px"}, 1000, "easeInQuad", function() {
					circle.animate({width: "0px"}, 600, function() {
						circle.remove();
					});
				});
			});
		});
		
		$("body").on("click", ".rename-circle", function() {
			$(this).closest("div.hidden-content").children("div.input-group").show("slide", {direction: "up"}, 600);
		});
		
		$("body").on("click", ".rename-button", function() {
			var circleId = $(this).closest("div.hidden-content").attr("id");
			var newCircleName = $(this).closest(".input-group").find(".rename-name").val();
			$.ajax({
				type: "post",
				url: "tools/protected/circle_utils.php",
				data: {"action": "rename_circle", "circle_id": circleId, "new_circle_name": newCircleName}
			});
			$("#circles").find("li.outer-circle#" + circleId).find(".circle-name").fadeOut(200, function() {
				$(this).text(newCircleName);
				$(this).fadeIn(200);
			});
			$(this).closest("div.input-group").hide("slide", {direction: "up"}, 600);
		});
		
		$("body").on("click", ".delete-user", function() {
			var circleId = $(this).closest("div.hidden-content").attr("id");
			var friend = $(this).closest(".friend");
			var userHash = friend.attr("id");
			$.ajax({
				type: "post",
				url: "tools/protected/circle_utils.php",
				data: {"action":"delete_user_from_circle", "circle_id": circleId, "member_to_delete": userHash},
				success: function(response) {
					if (response == 1) {
						friend.hide("slide", {direction: "left"}, 500, function() {
							$(this).remove();
						});
						var circle = $("body").find(".outer-circle#" + circleId);
						circle.find(".friend#" + userHash).remove();
						circle.find(".member-no").fadeOut(200, function() {
							$(this).text(parseInt($(this).text()) - 1);
							$(this).fadeIn(200);
						});
					}
				}
			});
		});
		
		$("#search").on("input", function(ev) {
			var filter = $(this).val();
			if (filter) {
				var regex = new RegExp(filter, "i");
				$("#friends").children("li").each(function() {
					if (regex.test($(this).text())) {
						$(this).fadeIn(200);
					}
					else {
						$(this).fadeOut(200);
					}
				});
			}
			else {
				$("#friends li").fadeIn(200);
			}
		});

	});

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

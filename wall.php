<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        
            include_once("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
        
            include_once("includes/html-includes.php");     
            
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"] . ") LIMIT 1"))
            {
                $profile = $result->fetch_object();
            }
            
        ?>

        <link href="css/wall.css" rel="stylesheet" type="text/css" />
        <script src="js/wall.js"></script>
        
    </head>


    <body class="skin-blue">
  
		<?PHP
			include_once("includes/header.php"); 
        ?>    
        <div class="wrapper row-offcanvas row-offcanvas-left">
        
	
            <?PHP include_once('includes/sidebar.php'); ?>
            <script>$(document).ready(function () {
				$("#wall_menu").addClass("active");
				
				$( "#share-photo-btn" ).click(function() {
					$( "#fileupload" ).attr("data-photoType","share-photo");
					$( "#fileupload" ).attr("data-photo-privacy",$("#privacy-select").val());
					$( "#fileupload" ).attr("data-photo-caption",$("#status_update").val());
				});	
			});
			</script>
			
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
                    
                    <div class="col-md-10 col-md-offset-1">
                        
                        <div class="row">
                        
                            <!-- Default box -->
                            <div class="box status_update_box">
                            
                                <div class="box-header">
                                
                                    <i class="fa fa-bullhorn"></i>
                                    <h3 class="box-title">Post something!</h3>
                                    
                                    <select class="form-control" id="privacy-select">
                                    
                                        <option>Public</option>
                                        <option>Friends</option>
                                        <option>Friends of friends</option>
                                        
                                        <?PHP
                                        
                                            if ($result = $mysqli->query("SELECT * FROM circle WHERE owner_user_id = " . $_SESSION["user_id"])) {
                                                for ($i = 0; $i < $result->num_rows; $i++) {
                                                    $circle = $result->fetch_object();
                                                    
                                                    echo "<option value=$circle->id>$circle->name</option>";
                                                }                                
                                            }                            
                                        
                                        ?>
                                            
                                    </select>
                                    
                                    <span id="privacy-setting-span">Privacy setting</span>
                                </div>
                                
                                <div class="box-body">
                                    <input type="text" id="status_update" placeholder="What's on your mind?">
                                </div><!-- /.box-body -->
                                
                                <div class="box-footer">
								
									<button class="btn btn-info"  id="share-photo-btn" data-toggle="modal" data-target="#photoUploadModal">Share photo</button>
                                    <button class="btn btn-primary" id="post_button" onclick="postStatusUpdate();">Post</button>
                                </div><!-- /.box-footer-->
                                
                            </div><!-- /.box -->
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-md-8 col-md-offset-2" id="posts_container">
                    
                        <?PHP
                        
                            if ($result = $mysqli->query("SELECT * FROM post WHERE user_id = " . $_SESSION["user_id"] . " AND deleted = 0 ORDER BY date DESC LIMIT 100")) {
                                for ($i = 0; $i < $result->num_rows; $i++) {
                                    $post = $result->fetch_object();
                                    
									$post_photo_url=null;
									if($post->main_type==1 && isset($post->photo_id)){
										 if ($result_photo = $mysqli->query("SELECT * FROM photo WHERE id=".$post->photo_id." LIMIT 1")) {
											$photo = $result_photo->fetch_object(); 
											$post_photo_url = $photo->photo_url;
										}										 
									}
									
									$image_string='';
									if($post_photo_url!=null){
										$image_string="<img class='post_image' src='".$post_photo_url."'/><p/>";			
									}
                                    echo "<div class='row'>
                                              <div data-id=$post->id class='box box-primary' style='width:600px'>
											  <div class='box-header' style='margin-left:10px'>
												    <img src='".$profile_photo_url."' class='img-circle' alt='User Image' style='height:55px;width:55px;border: 2px solid #3c8dbc;margin-top:4px;margin-right:5px'/>
												<a href='#' style='color:#3D8DBC;font-weight:bold'>".$profile->name . " " . $profile->surname."</a>
											  </div>
                                                  <div class='box-body'>".$image_string."
														<p>" . $post->content . "</p>
                                                      <div class='add-comment-box'>
                                                        <input class='add-comment' type='text' placeholder='Type your comment here'><button class='btn btn-success comment_button' onclick='addComment(this);'>Comment</button>
                                                      </div>";
                                                      
                                    $comments = $mysqli->query("SELECT * FROM comment WHERE post_id = $post->id ORDER BY date ASC");
                                    for ($j = 0; $j < $comments->num_rows; $j++)
                                    {
                                        $comment = $comments->fetch_object();
                                        
                                        $userThatCommented = $mysqli->query("SELECT * FROM user WHERE id = $comment->user_id LIMIT 1")->fetch_object();
                                        $profileThatCommented = $mysqli->query("SELECT * FROM profile WHERE id = $userThatCommented->profile_id LIMIT 1")->fetch_object();
                                        
                                        echo "<div data-id=$comment->id class='box box-primary comment-box'>
                                                  <div class='box-body'>
                                                      <a href='view_profile.php?id=$userThatCommented->id'>$profileThatCommented->name $profileThatCommented->surname</a> $comment->content
                                                  </div>";
                                                  
                                        if ($_SESSION["admin"] == 1 || $comment->user_id == $_SESSION["user_id"])
                                        {
                                            echo "
                                                  <div class='box-footer'>
                                                      <button class='btn btn-danger delete_comment_button' onclick='deleteComment(this);'>Delete</button>
                                                  </div><!-- /.box-footer-->";
                                        }
                                        
                                        echo "</div>";
                                        
                                    }
                                    
                                    echo "</div><!-- /.box-body -->
                                                  <div class='box-footer'>
                                                      <button class='btn btn-danger delete_button' onclick='deletePost(this);'>Delete</button>
                                                  </div><!-- /.box-footer-->
                                              </div><!-- /.box -->
                                          </div>";
                                }                                
                            }                            
                        
                        ?>
                    
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
		
	    </body>
</html>

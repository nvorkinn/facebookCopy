<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        
            require("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
        
            require("includes/html-includes.php");     
            
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
                    
                        <li class="active">
                            <a href="wall.php">
                                <i class="fa"></i> <span>Wall</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="messages.php">
                                <i class="fa"></i> <span>Messages</span>
                            </a>
                        </li>
                        
                        <li>
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
                    
                    <div class="col-md-4 col-md-offset-4">
                        
                        <div class="row">
                        
                            <!-- Default box -->
                            <div class="box status_update_box">
                            
                                <div class="box-body">
                                    <input type="text" id="status_update" placeholder="What's on your mind?">
                                </div><!-- /.box-body -->
                                
                                <div class="box-footer">
                                    <button class="btn btn-primary" id="post_button" onclick="postStatusUpdate();">Post</button>
                                </div><!-- /.box-footer-->
                                
                            </div><!-- /.box -->
                            
                        </div>
                        
                    </div>
                    
                    <div class="col-md-4 col-md-offset-4" id="posts_container">
                    
                        <?PHP
                        
                            if ($result = $mysqli->query("SELECT * FROM post WHERE user_id = " . $_SESSION["user_id"] . " AND deleted = 0 LIMIT 100")) {
                                for ($i = 0; $i < $result->num_rows; $i++) {
                                    $post = $result->fetch_object();
                                    
                                    echo "<div class='row'>
                                              <div class='box box-primary'>
                                                  <div class='box-body'>
                                                      <p>" . $post->content . "</p>
                                                  </div><!-- /.box-body -->
                                                  <div class='box-footer'>
                                                      <button class='btn btn-success' class='like_button' onclick='like(this);'>Like</button>
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

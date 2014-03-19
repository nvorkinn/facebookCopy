<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        		
            require("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
            
            require("includes/html-includes.php");
            require("includes/Modals.php"); 	
            
            
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"] . ") LIMIT 1"))
            {
                $profile = $result->fetch_object();
            }
            
            $blogId = $mysqli->real_escape_string($_GET["id"]);
            
        ?>
        

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
                        
                        <li>
                            <a href="activity.php">
                                <i class="fa"></i> <span>Activity log</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="blog.php">
                                <i class="fa"></i> <span>Blog</span>
                            </a>
                        </li>
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
                
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                
                <div class="col-md-10 col-md-offset-1">
                    
                    <?PHP
                    
                        if ($result = $mysqli->query("SELECT * FROM blog WHERE id = $blogId LIMIT 1"))
                        {
                            $blog = $result->fetch_object();
                            
                            echo "<div class='row'>
                                      <div class='box box-primary'>
                                          <div class='box-header'>
                                              <h3 class='box-title'><b>" . $blog->title . "</b> from " . date("d M Y H:i:s", strtotime($blog->date)) . "</h3>
                                          </div>
                                          <div class='box-body'>
                                              <p>" . $blog->content . "</p>
                                          </div><!-- /.box-body -->
                                      </div><!-- /.box -->
                                  </div>";
                        }                            
                    
                    ?>
                    
                </div>
                    
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
   
    </body>

</html>

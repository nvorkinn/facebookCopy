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
        
        <script src="js/view_blog.js"></script>

    </head>


    <body class="skin-blue">
    
 
        <?PHP
        
			require("includes/header.php"); 
            
        ?>    
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
        
            <?PHP include_once('includes/sidebar.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                
                <div class="col-md-10 col-md-offset-1">
                    
                    <?PHP
                    
                        if ($result = $mysqli->query("SELECT * FROM blog WHERE id = $blogId LIMIT 1"))
                        {
                            $blog = $result->fetch_object();
                            
                            echo "<div class='row'>
                                      <div data-id=$blog->id class='box box-primary'>
                                          <div class='box-header'>
                                              <h3 class='box-title'><b>" . $blog->title . "</b> from " . date("d M Y H:i:s", strtotime($blog->date)) . "</h3>
                                          </div>
                                          <div class='box-body'>
                                              <p>" . $blog->content . "</p>
                                          </div><!-- /.box-body -->";
                            if ($_SESSION["admin"] == 1 || $blog->user_id == $_SESSION["user_id"])
                            {
                                echo "
                                <div class='box-footer'>
                                    <button class='btn btn-danger delete_button' onclick='deleteBlog(this);'>Delete</button>
                                </div>";
                            }
                            echo "
                                      </div><!-- /.box -->
                                  </div>";
                        }                            
                    
                    ?>
                    
                </div>
                    
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
   
    </body>

</html>

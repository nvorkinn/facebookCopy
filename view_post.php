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
                        
            $postId = $mysqli->real_escape_string($_GET["id"]);
            
        ?>

        <link href="css/wall.css" rel="stylesheet" type="text/css" />
        <script src="js/view_post.js"></script>
        

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
                    
                        if ($result = $mysqli->query("SELECT * FROM post WHERE id = $postId LIMIT 1"))
                        {
                            $post = $result->fetch_object();
                            
                            echo "<div class='row'>
                                      <div data-id=$post->id class='box box-primary'>
                                          <div class='box-body'>
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
                                              
                                   
                            echo "</div><!-- /.box-body -->";           
                            if ($_SESSION["admin"] == 1 || $post->user_id == $_SESSION["user_id"])
                            {
                                echo "
                                <div class='box-footer'>
                                    <button class='btn btn-danger delete_button' onclick='deletePost(this);'>Delete</button>
                                </div>";
                            }
                            echo "</div><!-- /.box-body -->
                                      </div><!-- /.box -->
                                  </div>";
                        }                            
                    
                    ?>
                    
                </div>
                    
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
   
    </body>

</html>

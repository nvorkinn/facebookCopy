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
        
        <script src="js/blog.js"></script>
        <link type="text/css" rel="stylesheet" href="css/blog.css">
        
    </head>


    <body class="skin-blue">
    
        <?PHP
			require("includes/header.php"); 
        ?>    
        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?PHP include_once('includes/sidebar.php'); ?>
            <script>$(document).ready(function () {$("#blog_menu").addClass("active");});</script>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">
                    
                        <div class="col-md-12">
                            
                            <div class="row">
                            
                                <div class="box" id="blog">
                                    <div class="box-header">
                                        <input placeholder="Blog entry title" id="blog-entry-title" type="text">
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
                                    </div><!-- /.box-header -->
                                    <div class="box-body pad">
                                        <form>
                                            <textarea class="textarea" id="blog-editor" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>                      
                                        </form>
                                    </div>
                                    <div class="box-footer">                                    
                                        <button class='btn btn-success save_button' onclick='saveBlog(this);'>Save</button>
                                    </div>
                                </div>
                                
                                <script>$(document).ready(function() { $("#blog-editor").wysihtml5();});</script>
                            
                            </div>
                            
                        </div>
                        
                    </div>
                    
                    <div class="row" id="blog-entries-wrapper">
                    
                        <?PHP
                        
                            if ($result = $mysqli->query("SELECT * FROM blog WHERE user_id = " . $_SESSION["user_id"] . " ORDER BY date DESC"))
                            {
                                for ($i = 0; $i < $result->num_rows; $i++)
                                {
                                    $blog = $result->fetch_object();
                                    
                                    echo "
                                    \n
                                    <div data-id=$blog->id class='small-box bg-blue blog-entry'>
                                        <div class='inner'>
                                            <a href='view_blog.php?id=$blog->id'>
                                                " . $blog->title . " from " . date("d M Y H:i:s", strtotime($blog->date)) . "
                                            </a>
                                        </div>
                                        <div class='box-footer'>
                                            <button class='btn btn-danger delete_button' onclick='deleteBlog(this);'>Delete</button>
                                        </div>
                                    </div>\n\n";
                                }
                            }
                        
                        ?>
                    
                    </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
		
	    </body>
</html>

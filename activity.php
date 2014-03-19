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

        <link href="css/activity.css" rel="stylesheet" type="text/css" />
        <script src="js/activity.js"></script>
        
    </head>


    <body class="skin-blue">
    
        <?PHP
			require("includes/header.php"); 
        ?>    
        <div class="wrapper row-offcanvas row-offcanvas-left">
        

            <?PHP include_once('includes/sidebar.php'); ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
                    
                    <div class="row">
                    
                        <div class="col-md-12">
                    
                            <ul class="timeline">
                                
                                <?PHP
                                
                                    if ($result = $mysqli->query("SELECT * FROM activity WHERE from_user_id = " . $_SESSION["user_id"] . " OR to_user_id = " . $_SESSION["user_id"] . " ORDER BY created_date ASC"))
                                    {
                                        $currentDate = 0;
                                        for ($i = 0; $i < $result->num_rows; $i++)
                                        {
                                            $activity = $result->fetch_object();
                                            
                                            $date = floor(strtotime($activity->created_date) / 86400);
                                            if ($date != $currentDate)
                                            {
                                                $currentDate = $date;
                                                
                                                echo "<!-- timeline time label -->
                                                        <li class='time-label'>
                                                            <span class='bg-red'>
                                                                " . date("d M Y", strtotime($activity->created_date)). "
                                                            </span>
                                                        </li>
                                                        <!-- /.timeline-label -->";
                                            }
                                            
                                            echo "<li>";
                                                              
                                            if ($activity->main_type == 0)
                                            {
                                                if ($activity->sub_type == 0)
                                                {
                                                    // Friend request
                                                    if ($activity->from_user_id == $_SESSION["user_id"])
                                                    {
                                                        $otherPerson = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = $activity->to_user_id LIMIT 1) LIMIT 1")->fetch_object();
                                                        
                                                        echo "<i class='fa fa-user bg-blue'></i><div class='timeline-item'><span class='time'><i class='fa fa-clock-o'></i> " . date("H:i:s", strtotime($activity->created_date)) . "</span><div class='timeline-body'>You requested <a href='view_profile.php?id=$activity->to_user_id'>$otherPerson->name $otherPerson->surname</a>'s friendship</div></div>";
                                                    }
                                                    else
                                                    if ($activity->to_user_id == $_SESSION["user_id"])
                                                    {
                                                        $otherPerson = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = $activity->from_user_id LIMIT 1) LIMIT 1")->fetch_object();
                                                        
                                                        echo "<i class='fa fa-user bg-blue'></i><div class='timeline-item'><span class='time'><i class='fa fa-clock-o'></i> " . date("H:i:s", strtotime($activity->created_date)) . "</span><div class='timeline-body'><a href='view_profile.php?id=$activity->from_user_id'>$otherPerson->name $otherPerson->surname</a> requested your friendship</div></div>";
                                                    }
                                                }
                                            }
                                            else
                                            if ($activity->main_type == 2)
                                            {
                                                if ($activity->sub_type == 1)
                                                {
                                                    // Friend request acception
                                                    if ($activity->from_user_id == $_SESSION["user_id"])
                                                    {
                                                        $otherPerson = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = $activity->to_user_id LIMIT 1) LIMIT 1")->fetch_object();
                                                        
                                                        echo "<i class='fa fa-user bg-blue'></i><div class='timeline-item'><span class='time'><i class='fa fa-clock-o'></i> " . date("H:i:s", strtotime($activity->created_date)) . "</span><div class='timeline-body'>You accepted <a href='view_profile.php?id=$activity->to_user_id'>$otherPerson->name $otherPerson->surname</a>'s friendship request</div></div>";
                                                    }
                                                    else
                                                    if ($activity->to_user_id == $_SESSION["user_id"])
                                                    {
                                                        $otherPerson = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = $activity->from_user_id LIMIT 1) LIMIT 1")->fetch_object();
                                                        
                                                        echo "<i class='fa fa-user bg-blue'></i><div class='timeline-item'><span class='time'><i class='fa fa-clock-o'></i> " . date("H:i:s", strtotime($activity->created_date)) . "</span><div class='timeline-body'><a href='view_profile.php?id=$activity->from_user_id'>$otherPerson->name $otherPerson->surname</a> accepted your friendship request</div></div>";
                                                    }
                                                }
                                            }
                                            else
                                            if ($activity->main_type == 3)
                                            {
                                                if ($activity->sub_type == 0)
                                                {
                                                    // Post
                                                    $post = $mysqli->query("SELECT * FROM post WHERE id = $activity->object_id LIMIT 1")->fetch_object();
                                                    echo "<i class='fa fa-bullhorn bg-blue'></i><div class='timeline-item'><span class='time'><i class='fa fa-clock-o'></i> " . date("H:i:s", strtotime($activity->created_date)) . "</span><div class='timeline-body'>You posted <a href='view_post.php?id=$post->id'>$post->content</a> from <b>$post->location</b></div></div>";
                                                }
                                            }
                                            else
                                            if ($activity->main_type == 4)
                                            {
                                                if ($activity->sub_type == 0)
                                                {
                                                    // Blog
                                                    $blog = $mysqli->query("SELECT * FROM blog WHERE id = $activity->object_id LIMIT 1")->fetch_object();
                                                    echo "<i class='fa fa-file-text-o bg-blue'></i><div class='timeline-item'><span class='time'><i class='fa fa-clock-o'></i> " . date("H:i:s", strtotime($activity->created_date)) . "</span><div class='timeline-body'>You made a blog entry titled <a href='view_blog.php?id=$blog->id'>$blog->title</a></div></div>";
                                                }
                                            }
                                            
                                            echo "</li>";
                                        }
                                    }
                                    
                                ?>
                                
                            </ul>
                        
                        </div>
                    
                    </div>
                        
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
		
	    </body>
</html>

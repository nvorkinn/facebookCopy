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
            
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_GET["id"] . ") LIMIT 1"))
            {
                $user_profile = $result->fetch_object();
            }
            
            $currentUserId = $mysqli->real_escape_string($_GET["id"]);
            
        ?>
        
        <link href="css/profile.css" rel="stylesheet" type="text/css" />
        <script src="js/view_profile.js"></script>
        
        <script>var currentUserId = <?PHP echo $currentUserId; ?>;</script>

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
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
                
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            
                <div class="row centered">
                
                    <div class="user-header cover">
                        <img src="img/avatar3.png" class="img-circle" alt="User Image" />
						<p class="user-name">
                            <?PHP
                
                                if (isset($user_profile)) {
                                    echo $user_profile->name . " " . $user_profile->surname;
                                }
                
                            ?>
                        </p>
                        
                        <?PHP
                        
                            // Check relationship status between logged in user and current user
                            $result = $mysqli->query("SELECT * FROM activity WHERE id IN (SELECT activity_id FROM relationship) AND type = 0 AND sub_type = 0 AND ((from_user_id = " . $_SESSION["user_id"] . " AND to_user_id = $currentUserId) OR (to_user_id = " . $_SESSION["user_id"] . " AND from_user_id = $currentUserId))");
                            
                            if ($result->num_rows != 0) // Friends already
                            {
                                echo "<button id='add-friend-btn' class='btn btn-default' disabled>Already your friend!</button>";
                            }
                            else
                            {
                                // Check if request sent but not answered
                                $result = $mysqli->query("SELECT * FROM activity WHERE type = 0 AND sub_type = 0 AND ((from_user_id = " . $_SESSION["user_id"] . " AND to_user_id = $currentUserId) OR (to_user_id = " . $_SESSION["user_id"] . " AND from_user_id = $currentUserId))");
                                
                                if ($result->num_rows != 0)
                                {
                                    echo "<button id='add-friend-btn' class='btn btn-default' disabled>Friend request sent!</button>";
                                }
                                else
                                {
                                    echo "<button id='add-friend-btn' class='btn btn-default'>Add as friend</button>";
                                }
                            }
                            
                        ?>
                        
                    </div>
                    
                </div>
                
                <div class="row">
                
                   <div class="nav-tabs-custom col-lg-12">
                   
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                            <li><a href="#friends" data-toggle="tab">Friends</a></li>
                        </ul>
                        
                        <div class="tab-content">
                        
                            <div class="tab-pane active" id="information">
                                
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Contact</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                            <table class="no-border">
                                            
                                                <tr>
                                                    <td class="header">Website</td>
                                                    <td>
                                                        <?PHP
                                                        
                                                            if (isset($user_profile))
                                                            {
                                                                echo "www.example.com";
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">E-mail</td>
                                                    <td>
                                                        <?PHP
                                                        
                                                            if (isset($user_profile))
                                                            {
                                                                echo $user_profile->email;
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">Mobile</td>
                                                    <td>
                                                        <?PHP
                                                        
                                                            if (isset($user_profile))
                                                            {
                                                                echo "+1234567890";
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">Location</td>
                                                    <td>
                                                        <?PHP
                                                        
                                                            if (isset($user_profile))
                                                            {
                                                                echo "London, United Kingdom";
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </p>
                                    </div><!-- /.box-body -->
                                    
                                </div>
                                
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Personal information</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                            <table class="no-border">
                                            
                                                <tr>
                                                    <td class="header">Date of birth</td>
                                                    <td>
                                                        <?PHP
                                                        
                                                            if (isset($user_profile))
                                                            {
                                                                echo $user_profile->dob;
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </p>
                                    </div><!-- /.box-body -->
                                    
                                </div>
                                
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Education</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                        </p>
                                    </div><!-- /.box-body -->
                                    
                                </div>
                                
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Places lived</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                        </p>
                                    </div><!-- /.box-body -->
                                    
                                </div>
                                
                            </div><!-- /.tab-pane -->
                            
                            <div class="tab-pane" id="friends">
                            
                                <?PHP
                                
                                    $friends = array();
                                    
                                    // Get friending activities that already caused a relationship
                                    $result = $mysqli->query("SELECT * FROM activity WHERE id IN (SELECT activity_id FROM relationship) AND type = 0 AND sub_type = 0");
                                    
                                    // For every friending in which the user was involved, add the other person to the array
                                    for ($i = 0; $i < $result->num_rows; $i++)
                                    {
                                        $activity = $result->fetch_object();
                                        
                                        if ($activity->from_user_id == $currentUserId)
                                        {
                                            array_push($friends, $activity->to_user_id);
                                        }
                                        else
                                        if ($activity->to_user_id == $currentUserId)
                                        {
                                            array_push($friends, $activity->from_user_id);
                                        }
                                    }
                                    
                                    // Make sure there are no duplicates
                                    $friends = array_unique($friends);
                                    $keys = array_keys($friends);
                                    
                                    // Create a card for each friend
                                    for ($i = 0; $i < count($keys); $i++)
                                    {
                                        $friend = $mysqli->query("SELECT * FROM user WHERE id = " . $friends[$keys[$i]] . " LIMIT 1")->fetch_object();
                                        
                                        $profile = $mysqli->query("SELECT * FROM profile WHERE id = $friend->profile_id LIMIT 1")->fetch_object();
                                        
                                        echo "
                                        \n
                                        <div class='small-box bg-green friend centered'>
                                            <div class='inner'>
                                                <img src='img/avatar3.png' class='img-circle' alt='User Image' />
                                                <a class='user-name' href='view_profile.php?id=$friend->id'>
                                                    " . $profile->name . " " . $profile->surname . "
                                                </a>
                                            </div>
                                        </div>\n\n";
                                    }
                                    
                                    if (count($keys) == 0)
                                    {
                                        echo "Here is where you friends would be. If you had any that is.";
                                    }
                                
                                ?>
                                
                            
                                
                            </div><!-- /.tab-pane -->
                            
                        </div><!-- /.tab-content -->
                        
                    </div><!-- nav-tabs-custom -->
                
                </div>

                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
   
    </body>

</html>

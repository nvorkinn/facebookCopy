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
            
        ?>
        
        <link href="css/profile.css" rel="stylesheet" type="text/css" />
        <script src="js/profile.js"></script>
		<script>
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
                        
                        <li>
                            <a href="circles.php">
                                <i class="fa"></i> <span>Circles</span>
                            </a>
                        </li>
                        
                        <li class="active">
                            <a href="profile.php">
                                <i class="fa"></i> <span>Profile</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="activity.php">
                                <i class="fa"></i> <span>Activity log</span>
                            </a>
                        </li>
                    </ul>
                    
                </section>
                <!-- /.sidebar -->
                
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
            
                <div class="row centered">
                
					<?PHP
                        $cover_url="url('";
                        if($profile->cover_photo_id!=NULL){
                                if ($result = $mysqli->query("SELECT photo_url FROM photo WHERE photo.id=$profile->cover_photo_id LIMIT 1")){
                                    $row= $result->fetch_assoc();
                                    $cover_url=$cover_url.$row['photo_url']."')";
                                }
                            }
                        
                        echo '<div class="user-header cover" style="background:'.$cover_url.';background-size:100% auto">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                            <p class="user-name">';
                    
                                    if (isset($profile)) {
                                        echo $profile->name . " " . $profile->surname;
                                    }
                   
                          echo '</p>
                            <button id="cover-photo-btn" class="btn btn-default" data-toggle="modal" data-target="#photoUploadModal">Change cover photo</button>
                            
                        </div>';
					?>
                    
                </div>
                
                <div class="row">
                
                   <div class="nav-tabs-custom col-lg-12">
                   
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#information" data-toggle="tab">Information</a></li>
                            <li><a href="#friends" data-toggle="tab">Friends</a></li>
                            <li><a href="#settings" data-toggle="tab">Settings</a></li>
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
                                                        
                                                            if (isset($profile))
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
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo $profile->email;
                                                            }
                                                            
                                                        ?>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">Mobile</td>
                                                    <td>
                                                        <?PHP
                                                        
                                                            if (isset($profile))
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
                                                        
                                                            if (isset($profile))
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
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo $profile->dob;
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
                                        
                                        if ($activity->from_user_id == $_SESSION["user_id"])
                                        {
                                            array_push($friends, $activity->to_user_id);
                                        }
                                        else
                                        if ($activity->to_user_id == $_SESSION["user_id"])
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
                            
                            <div class="tab-pane" id="settings">
                                    
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Name</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                    
                                        <table class="no-border">
                                        
                                            <tr>
                                                <td class="header">Name</td>
                                                <td>
                                                    <input type="text" id="name" value="<?PHP
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo $profile->name;
                                                            }
                                                            
                                                        ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="header">Surname</td>
                                                <td>
                                                    <input type="text" id="surname" value="<?PHP
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo $profile->surname;
                                                            }
                                                            
                                                        ?>">
                                                </td>
                                            </tr>
                                            
                                        </table>
                                        
                                    </div><!-- /.box-body -->
                                    
                                </div>
                                    
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Password</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                    
                                        <table class="no-border">
                                        
                                            <tr>
                                                <td class="header">Password</td>
                                                <td>
                                                    <input type="password" id="password">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="header">Password confirmation</td>
                                                <td>
                                                    <input type="password" id="password_confirmation">
                                                </td>
                                            </tr>
                                            
                                        </table>
                                        
                                    </div><!-- /.box-body -->
                                    
                                </div>
                            
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
                                                        <input type="text" id="website" value="<?PHP
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo "www.example.com";
                                                            }
                                                            
                                                        ?>">
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">E-mail</td>
                                                    <td>
                                                        <input type="email" id="email" value="<?PHP
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo $profile->email;
                                                            }
                                                            
                                                        ?>">
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">Mobile</td>
                                                    <td>
                                                        <input type="text" id="mobile" value="<?PHP
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo "+1234567890";
                                                            }
                                                            
                                                        ?>">
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="header">Location</td>
                                                    <td>
                                                        <input type="text" id="location" value="<?PHP
                                                        
                                                            if (isset($profile))
                                                            {
                                                                echo "London, United Kingdom";
                                                            }
                                                            
                                                        ?>">
                                                    </td>
                                                </tr>
                                            </table>
                                        </p>
                                    </div><!-- /.box-body -->
                                    
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
                                                            <input type="date" id="dob">
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
                                    
                                </div>
                                
                                <button type="button" class="btn btn-primary" onclick="saveSettings();">Save</button>
                                
                            </div><!-- /.tab-pane -->
                            
                        </div><!-- /.tab-content -->
                        
                    </div><!-- nav-tabs-custom -->
                
                </div>

                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
   
    </body>

</html>

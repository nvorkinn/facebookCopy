<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        		
            include_once("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
            
            include_once("includes/html-includes.php");
			include_once("includes/Modals.php");
      	
			$profile_photo_url=NULL;
                        
		
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"] . ") LIMIT 1"))
            {
                $profile = $result->fetch_object();
				
				
						if($profile->profile_photo_id!=NULL){
                                if ($result = $mysqli->query("SELECT photo_url FROM photo WHERE photo.id=$profile->profile_photo_id LIMIT 1")){
                                    $row= $result->fetch_assoc();
                                    $profile_photo_url=$row['photo_url'];
                                }
                        }else{
							$profile_photo_url="img/avatar3.png";
						}
				
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
        
            <?PHP include_once('includes/sidebar.php'); ?>
            <script>$(document).ready(function () {$("#profile_menu").addClass("active");});</script>
			
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
                            <img src="'.$profile_photo_url.'" class="profile-pic img-circle" alt="User Image" />
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
                                        <h3 class="box-title">Profile picture</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
										<button id="profile-photo-btn" class="btn btn-primary" data-toggle="modal" data-target="#photoUploadModal">Change profile photo</button>
									
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
                                
                                <!--
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Education</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                        </p>
                                    </div>
                                    
                                </div>
                                
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Places lived</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                        </p>
                                    </div>
                                    
                                </div>
                                !-->
                                
                            </div><!-- /.tab-pane -->
                            
                            <div class="tab-pane" id="friends">
                            
                                <?PHP
                                
                                    $friends = array();
                                    
                                    // Get friending activities that already caused a relationship
                                    $result = $mysqli->query("SELECT * FROM activity WHERE id IN (SELECT activity_id FROM relationship) AND main_type = 0 AND sub_type = 0");
                                    
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
                        
										$user_dp=NULL;
											if($profile->profile_photo_id!=NULL){
												if ($result = $mysqli->query("SELECT photo_url FROM photo WHERE photo.id=$profile->profile_photo_id LIMIT 1")){
													$row= $result->fetch_assoc();
													$user_dp=$row['photo_url'];
												}
											}else{
												$user_dp="img/avatar3.png";
											}
						
                                        echo "
                                        \n
                                        <div class='small-box bg-green friend centered'>
                                            <div class='inner'>
											
											    <img src='$user_dp' class='img-circle' alt='User Image' />
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
                                                        <input type="date" id="dob">
                                                    </td>
                                                </tr>
                                                
                                            </table>
                                        </p>
                                    </div><!-- /.box-body -->
                                    
                                </div>
                                <!--
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Education</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                        </p>
                                    </div>
                                    
                                </div>
                                
                                <div class="box box-primary">
                                
                                    <div class="box-header" data-toggle="tooltip" title="">
                                        <h3 class="box-title">Places lived</h3>    
                                    </div>
                                    
                                    <div class="box-body" style="display: block;">
                                        <p>
                                        </p>
                                    </div>
                                    
                                </div>
                                !-->
                                <button onClick="getXML();" class="btn btn-primary">Download user data as XML</button>
                                
                                <button type="button" class="btn btn-primary" onclick="saveSettings();">Save</button>
                                
                            </div><!-- /.tab-pane -->
                            
                        </div><!-- /.tab-content -->
                        
                    </div><!-- nav-tabs-custom -->
                
                </div>

                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
   
    </body>

	
				
				
<script>

$( document ).ready(function() {
    $( "#cover-photo-btn" ).click(function() {
		$( "#fileupload" ).attr("data-photoType","cover-photo");
	});
	$( "#profile-photo-btn" ).click(function() {
		$( "#fileupload" ).attr("data-photoType","profile-photo");
	});
});
</script>
	
	
</html>

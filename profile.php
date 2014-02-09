<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        
            require("includes/html-includes.php");
            require("includes/Modals.php"); 			
            require("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
            
            
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"] . ") LIMIT 1"))
            {
                $profile = $result->fetch_object();
            }
            
        ?>
        
        <link href="css/profile.css" rel="stylesheet" type="text/css" />
        <script src="js/profile.js"></script>

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
                
                                if (isset($profile)) {
                                    echo $profile->name . " " . $profile->surname;
                                }
                
                            ?>
                        </p>
						<button id="cover-photo-btn" class="btn btn-default" data-toggle="modal" data-target="#photoUploadModal">Change cover photo</button>
						
                    </div>
                    
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
                                
                                    if ($result = $mysqli->query("SELECT name, surname FROM profile"))
                                    {
                                        for ($i = 0; $i < $result->num_rows; $i++)
                                        {
                                            $friend = $result->fetch_object();
                                            
                                            echo "
                                            \n
                                            <div class='small-box bg-green friend centered'>
                                                <div class='inner'>
                                                    <img src='img/avatar3.png' class='img-circle' alt='User Image' />
                                                    <p class='user-name'>
                                                        " . $friend->name . " " . $friend->surname . "
                                                    </p>
                                                </div>
                                            </div>\n\n";
                                        }
                                        
                                        $result->close();
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


        <!-- jQuery 2.0.2 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
		

    </body>


</html>

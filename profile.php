<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        
            require("includes/html-includes.php"); 
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
            
                <div class="row">
                    
                    <div class="col-lg-4 centered" id="avatar">
                    
                        <img src="img/avatar3.png">
                            
                        <div class="spacer_small"></div>
                        
                        <button type="button" class="edit_button" style="float: none">Edit</button>
                        
                    </div>
                    
                    <div class="col-lg-8">

                        <div class="row profile-row">
                    
                            <div class="name col-lg-8">
                            
                                <h2>Name</h2>
                            
                                <h3>
                                    <?PHP
                                        
                                        if (isset($profile))
                                        {
                                            echo $profile->name;
                                        }
                                        
                                    ?>
                                </h3>
                                
                            </div>
                            
                            <button type="button" class="edit_button" onclick="editName(this);">Edit</button>
                            
                        </div>
                            
                        <div class="spacer"></div>

                        <div class="row profile-row">
                    
                            <div class="surname col-lg-8">
                            
                                <h2>Surname</h2>
                            
                                <h3>
                                    <?PHP
                                        
                                        if (isset($profile))
                                        {
                                            echo $profile->surname;
                                        }
                                        
                                    ?>
                                </h3>
                                
                            </div>
                            
                            <button type="button" class="edit_button" onclick="editSurname(this);">Edit</button>
                            
                        </div>
                            
                        <div class="spacer"></div>

                        <div class="row profile-row">
                    
                            <div class="dob col-lg-8">
                            
                                <h2>Date of birth</h2>
                            
                                <h3>
                                    <?PHP
                                        
                                        if (isset($profile))
                                        {
                                            echo $profile->dob;
                                        }
                                        
                                    ?>
                                </h3>
                                
                            </div>
                            
                            <button type="button" class="edit_button" onclick="editDOB();">Edit</button>
                            
                        </div>
                            
                        <div class="spacer"></div>

                        <div class="row profile-row">
                    
                            <div class="email col-lg-8">
                            
                                <h2>Email</h2>
                            
                                <h3>
                                    <?PHP
                                        
                                        if (isset($profile))
                                        {
                                            echo $profile->email;
                                        }
                                        
                                    ?>
                                </h3>
                                
                            </div>
                            
                            <button type="button" class="edit_button" onclick="editEmail(this);">Edit</button>
                            
                        </div>
                            
                        <div class="spacer"></div>

                        <div class="row profile-row">
                    
                            <div class="education col-lg-8">
                            
                                <h2>Education</h2>
                            
                                <h3>
                                </h3>
                                
                            </div>
                            
                            <button type="button" class="edit_button" onclick="addEducation();">Add</button>
                            
                        </div>
                            
                        <div class="spacer"></div>

                        <div class="row profile-row">
                    
                            <div class="places_lived col-lg-8">
                            
                                <h2>Places lived</h2>
                            
                                <h3>
                                </h3>
                                
                            </div>
                            
                            <button type="button" class="edit_button" onclick="addPlacesLived();">Add</button>
                            
                        </div>
                        
                        
                    
                    </div>
                        
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

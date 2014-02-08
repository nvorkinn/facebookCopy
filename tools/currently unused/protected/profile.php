<!DOCTYPE html>
<html lang="en">


    <head>
    
        <?PHP 
        
            session_start();
            
            require($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php"); 
            require($_SERVER["DOCUMENT_ROOT"] . "/includes/html-includes.php"); 
            require ($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");

            if(!isset($_SESSION["user_id"])){
                header("location:/login");
            }
            
            if(isset($_SESSION["admin"]) && $_SESSION["admin"]==1){
                header("location:/admin");
            }
            
            
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"] . ") LIMIT 1"))
            {
                $profile = $result->fetch_object();
            }
            
        ?>
        
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
        <script src="/js/bootstrap.min.js"></script>
        
        <link href="/css/profile.css" rel="stylesheet">
        <script src="/js/profile.js"></script>
        
        <script>
        
            $(function () { 
                $("#friends-notif").popover({title: "Friend Requests", content: "It's so simple to create a tooltop for my website!", placement: "bottom"});
            });
            
        </script>
        
    </head>
    

    <body>
    
        <div class="topbar">
        
            <div class="fill">
            
                <div class="container">
                
                    <a class="brand" id="logo" href="#" >FacebookCopy</a>

                    <a class="brand" id="friends-notif" href="#" style="margin-left:5px;" ><span class="glyphicon glyphicon-user" style="" ></span></a>

                </div>
                
            </div>

            <div class="container">

                <div class="content-white">
                
                    <div class="row">
                    
                        <div class="span4 centered">
                        
                            <img src="/images/avatar.jpg">
                                
                            <div class="spacer_small"></div>
                            
                            <button type="button" class="edit_button centered">Edit</button>
                            
                        </div>
                        
                        <div class="span16">

                            <div class="row profile-row">
                        
                                <div class="name span11 offset1">
                                
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
                        
                                <div class="surname span11 offset1">
                                
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
                        
                                <div class="dob span11 offset1">
                                
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
                        
                                <div class="email span11 offset1">
                                
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
                        
                                <div class="education span11 offset1">
                                
                                    <h2>Education</h2>
                                
                                    <h3>
                                    </h3>
                                    
                                </div>
                                
                                <button type="button" class="edit_button" onclick="addEducation();">Add</button>
                                
                            </div>
                                
                            <div class="spacer"></div>

                            <div class="row profile-row">
                        
                                <div class="places_lived span11 offset1">
                                
                                    <h2>Places lived</h2>
                                
                                    <h3>
                                    </h3>
                                    
                                </div>
                                
                                <button type="button" class="edit_button" onclick="addPlacesLived();">Add</button>
                                
                            </div>
                            
                            
                        
                        </div>
                        
                    </div>
                    
                    
                
                </div>

                <footer>
                    <p>&copy; FacebookCopy 2014</p>
                </footer>

            </div> <!-- /container -->

    </body>
  
 
</html>

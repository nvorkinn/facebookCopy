<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        
            session_start();
            require("includes/html-includes.php"); 
            require("includes/php-includes.php"); 
            
            if(isset($_SESSION["user_id"])){
                header("location: wall.php");
            }
            
        ?>
        
        <link href="css/index.css" rel="stylesheet" type="text/css" />

    </head>


    <body class="skin-blue">
    
        <!-- header logo: style can be found in header.less -->
        <header class="header">
        
            <a href="index.php" class="logo">Commy</a>
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation"></nav>
            
        </header>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Right side column. Contains the content of the page -->
            <aside class="right-side" style="margin-left: 0px">

                <!-- Main content -->
                <section class="content">
                
                    <div class="row">
                        
                        <div class="col-lg-4 col-xs-6 col-lg-offset-4 col-xs-offset-3">
                        
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                            
                                <div class="inner">
                                    <h3>
                                        <?PHP
                                        
                                            if ($result = $mysqli->query("SELECT * FROM user"))
                                            {
                                                echo $result->num_rows;
                                            }
                                        
                                        ?>
                                    </h3>
                                    <p>
                                        User Registrations
                                    </p>
                                </div>
                            
                            <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                
                            </div>
                            
                        </div><!-- ./col -->
                        
                    </div><!-- /.row -->
                    
                    <div class="row">
                    
                        <div class="col-lg-6 col-xs-12 col-lg-offset-3">
                        
                            <form class="form" id="login-form" name="form" action="" method="post">
                            
                                <div class="block">
                                
                                    <label for="email">@</label>
                                    <input type="text" name="login-email" placeholder="E-mail address" required/>
                                    </br>
                                    <label for="password">P</label>
                                    <input type="password" name="login-password" placeholder="Password" required />
                                    </br>
                                    <input type="submit" id="submit" name="submit" value="Sign in" class="btn btn-default btn-flat"/>
                                    
                                </div>
                                
                            </form>
                            
                            <script>
                            
                                $( document ).ready(function() {
                                
                                    $(function () {
                                    
                                        $("#login-form").on("submit", function (e) {
                                        
                                            $.ajax({
                                                type: "POST",
                                                url: "tools/login.php",
                                                data: $("#login-form").serialize(),
                                                success: function (response) {
                                                    console.log(response);
                                                    response = JSON.parse(response);

                                                    if(response.exists == true) {
                                                        sessionStorage.setItem("user_id", response.id);
                                                        window.location = "wall.php";
                                                    }
                                                }
                                            });
                                            
                                            e.preventDefault();
                                        });
                                        
                                    });
                                    
                                });
                                
                            </script>
                            
                        </div>
                    
                    </div>
                    
                    <div class="row">
                    
                        <div class="col-lg-6 col-xs-12 col-lg-offset-3">
                        
                            <form class="form" id="registration-form" name="form" action="#" method="post">
                            
                                <div class="block">
                                
                                    <label for="name">N</label>
                                    <input type="text" name="firstname" placeholder="Name" required/>
                                    </br>
                                    <label for="surname">S</label>
                                    <input type="text" name="lastname" placeholder="Surname" required/>
                                    </br>
                                    <label for="email">@</label>
                                    <input type="text" name="email" id="email" placeholder="E-mail address" required/>
                                    </br>
                                    <label for="email_confirm">@</label>
                                    <input type="text" name="email_confirm" id="reenteremail" placeholder="E-mail address" required/>
                                    </br>
                                    <label for="dob">D</label>
                                    <input type="date" name="birthdate" placeholder="Date of Birth" required/>
                                    </br>
                                    <label for="password">P</label>
                                    <input type="password" name="password" placeholder="Password" required />
                                    </br>
                                    <input type="submit" id="submit" name="submit" value="Register" class="btn btn-default btn-flat"/>
                                    
                                </div>
                                
                            </form>
                            
                            <script>

                                $( document ).ready(function() {

                                    var elem = document.getElementById("reenteremail");
                                    elem.addEventListener("blur", verifyEmail);


                                    function verifyEmail(input) {
                                        input = input.srcElement;
                                        
                                        if (input.value != document.getElementById("email").value) {
                                            // the provided value doesn’t match the primary email address
                                            input.setCustomValidity("The two email addresses must match.");
                                        } else {
                                            // input is valid -- reset the error message
                                            input.setCustomValidity("");
                                        }

                                    }

                                    $(function () {
                                    
                                        $("#registration-form").on("submit", function (e) {
                                        
                                            $.ajax({
                                                type: "POST",
                                                url: "tools/register.php",
                                                data: $("#registration-form").serialize(),
                                                success: function () {
                                                    alert("Form was submitted");
                                                    location.reload();
                                                }
                                            });
                                            
                                            e.preventDefault();
                                        });
                                        
                                    });
                                    
                                });

                            </script>
                            
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

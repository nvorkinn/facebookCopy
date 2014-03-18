<!DOCTYPE html>
<html class="bg-black">


    <head>
    
         <?PHP 
        
            require("includes/php-includes.php"); 
            
            if(isset($_SESSION["user_id"])){
                header("location: wall.php");
            }
            
            require("includes/html-includes.php"); 
            
        ?>

    </head>
    
    
    <body class="bg-black">

        <div class="form-box" id="login-box">
        
            <div class="header">Register</div>
            
            <form action="#" method="post" id="registration-form">
            
                <div class="body bg-gray">
                
                    <div class="form-group">
                        <input type="text" name="firstname" class="form-control" placeholder="Name"/>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="lastname" class="form-control" placeholder="Surname"/>
                    </div>
                                        
                    <div class="form-group">
                        <input type="text" name="email" id="reenteremail" class="form-control" placeholder="E-mail"/>
                    </div>
                    
                    <div class="form-group">
                        <input type="date" name="birthdate" class="form-control"/>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    
                </div>
                
                <div class="footer">                    

                    <button type="submit" class="btn bg-olive btn-block">Sign me up</button>

                    <a href="index.php" class="text-center">I already have a membership</a>
                    
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
                                success: function (data) {
									window.location = "index.php";
                                }
                            });
                            
                            e.preventDefault();
                        });
                        
                    });
                    
                });

            </script>
            
        </div>		

    </body>
    
    
</html>

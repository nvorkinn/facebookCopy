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
        
            <div class="header">Sign In</div>
            
            <form action="#" method="post" id="login-form">
            
                <div class="body bg-gray">
                    
                    <div class="form-group">
                        <input type="text" name="login-email" class="form-control" placeholder="Email"/>
                    </div>
                    
                    <div class="form-group">
                        <input type="password" name="login-password" class="form-control" placeholder="Password"/>
                    </div>          
                    
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                    
                </div>
                
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    
                    <p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.php" class="text-center">Register a new membership</a>
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
                                        sessionStorage.setItem("user_hash", response.hash);
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
    

    </body>
    
    
</html>

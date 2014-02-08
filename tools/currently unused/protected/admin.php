<!DOCTYPE html>


<html lang="en">


    <head>

        <?PHP 
            session_start();
            require("/../../includes/html-includes.php"); 
            
            if(!isset($_SESSION["user_id"]) || $_SESSION["admin"] != 1){
                header("location:/login");
            }
        ?>
        
    </head>

      
    <body>
    
        <div class="topbar">
        
            <div class="fill">
            
                <div id="login-error-bar">
                    <div style="padding-top:5px;">Oops.. it looks like you have entered incorrect login details try: <a href=""><u>Forgotten login details</u></a></div>
                </div>

                <div class="container">
                    <a class="brand" href="#">FacebookCopy</a>
                </div>
                
            </div>

            <div class="container">

                <div class="content-white"></div>

                <footer>
                    <p>&copy; FacebookCopy 2014</p>
                </footer>

            </div> <!-- /container -->
            
        </div>


        <script>
            $( document ).ready(function() {
                $("#login-error-bar").hide();

                $(function () {
                    $("form").on("submit", function (e) {
                        $('#login-error-bar').hide();
                        
                        $.ajax({
                            type: "POST",
                            url: "php/login.php",
                            data: $("form").serialize(),
                            success: function (response) {
                                response =JSON.parse(response);
                                if (response.exists == true){
                                    window.location.href = "/home";
                                }else{
                                    $("#login-error-bar").slideDown(500);
                                }
                            }
                        });
                        
                        e.preventDefault();
                    });
                });
            });
        </script>

    </body>
 
 
 
</html>

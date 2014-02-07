<!DOCTYPE html>
<html lang="en">
   <head>
      <?php 
         session_start();
         require("includes/html-includes.php"); 
         if(isset($_SESSION['user_id'])){
         	header("location:/home");
         }
         ?>
   </head>
   <body>
      <div class="topbar">
         <div class="fill">
            <div id="notif-bar">
               <div style="padding-top:5px;">Oops.. it looks like you have entered incorrect login details try: <a href=""><u>Forgotten login details</u></a></div>
            </div>
            <div class="container">
               <a class="brand" href="#">FacebookCopy</a>
               <form class="pull-right">
                  <input class="input-medium" type="email" placeholder="Email" name="login-email" required autofocus>
                  <input class="input-medium" type="password" placeholder="Password" name="login-password" required autofocus>
                  <button class="btn rounded" type="submit">Log in</button>
               </form>
            </div>
         </div>
         <div class="container">
            <div class="content">
               <div class="row" style="padding-top:20px">
                  <div class="span10">
                     <h2 style="font-weight:bold;color:#0E385F">FacebookCopy helps you connect and share with the people in your life.</h2>
                     <img style="padding-top:20px" src="images/home-graph.png" alt="graph">
                  </div>
                  <div class="span4">
                     <h3 style="font-weight:bold;font-size:30px;">Create an account</h3>
                     <iframe style="padding-top:20px"src="html/register.html" height="330" width="500" frameborder="0" scrolling="no" ></iframe>
                  </div>
               </div>
               <div id="DEBUG"></div>
            </div>
            <footer>
               <p>&copy; FacebookCopy 2014</p>
            </footer>
         </div>
         <!-- /container -->
      </div>
      <script>
         $( document ).ready(function() {
         	 $('#notif-bar').hide();
         	 	 
         	 $(function () {
                $('form').on('submit', function (e) {
         	
         	 $('#login-error-bar').hide();
         	  $.ajax({
                    type: 'post',
                    url: '/php/login.php',
                    data: $('form').serialize(),
                    success: function (response) {
         			response =JSON.parse(response);
         		  if(response.exists==true){
					sessionStorage.setItem("user_id", response.id);
         			window.location.href = "/home"
         		  }else{
         			 $('#notif-bar').slideDown(500);
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
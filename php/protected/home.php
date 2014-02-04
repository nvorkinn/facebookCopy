<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		session_start();
		require("../../includes/html-includes.php"); 
		if(!isset($_SESSION['user_id'])){
			header("location:/login");
		}
		if(isset($_SESSION['admin'])&&$_SESSION['admin']==1){
			header("location:/admin");
		}
	?>
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<script>
	$(function ()
		{ $("#friends-notif").popover({title: 'Friend Requests', content: "It's so simple to create a tooltop for my website!",placement:'bottom'});
	});
</script>

<script>
	$( document ).ready(function() {
		$("#logo" ).click(function() {
			$.ajax({
            type: 'post',
			data: {'action':'newActivity','to_user_id':'2','type':'0'},
            url: '../php/ACTION.php',
			success: function (response) {
				alert(response);
            }
          });
		});
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
		    
	</div>
	 
      <footer>
        <p>&copy; FacebookCopy 2014</p>
      </footer>

	 	  
    </div> <!-- /container -->
    </div>

  </body>
 
</html>

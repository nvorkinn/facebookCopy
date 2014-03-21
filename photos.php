<!DOCTYPE HTML>
<html>


    <head>
    
         <?PHP 
        
            require("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
        
            require("includes/html-includes.php");     
            
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"] . ") LIMIT 1"))
            {
                $profile = $result->fetch_object();
            }
            
        ?>
        
        <script src="js/blog.js"></script>
        <link type="text/css" rel="stylesheet" href="css/blog.css">
        
    </head>


    <body class="skin-blue">
    
        <?PHP
			require("includes/header.php"); 
        ?>    
        <div class="wrapper row-offcanvas row-offcanvas-left">

            <?PHP include_once('includes/sidebar.php'); ?>
            <script>$(document).ready(function () {$("#blog_menu").addClass("active");});</script>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">
				<div class="row">
				<div class="col-md-12">
                        
                   <div>
                   <button class="btn btn-primary" data-toggle="modal" data-target="#ambumcreatemodal">Create Album</button> 
				   </div>
				   </div>
				</div>
			
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
        </div><!-- ./wrapper -->
		
		
		
<div class="modal fade bs-modal-sm" id="ambumcreatemodal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title">Create Album</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
										<span class="input-group-addon"><i class="fa fa-pencil"></i></span>
										<input type="text" class="form-control" id="album-name" placeholder="Name">
				</div>
            </div>
			<div class="modal-footer">
				<button class="btn btn-success" data-dismiss="modal" id="album-create-btn" aria-hidden="true">Create</button>
			</div>
        </div>
    </div>
</div>

<script>

$(document).ready(function () {
	$("#album-create-btn").click(function(){
		var album_name = $("#album-name").val();
		if(album_name!=''){
			
		}
	});
});
			
</script>

	    </body>
</html>

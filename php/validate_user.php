<?php 
			if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
				
				$connection = mysqli_connect("localhost","root","root", "facebookcopy");
				
				// Get data off URL
				$email = mysqli_escape_string($connection, $_GET['email']); // Set email variable
				$hash = mysqli_escape_string($connection, $_GET['hash']); // Set hash variable
				
				// Search for un-verified entry
				$search = mysqli_query($connection, "SELECT email, hash, verified FROM user u, profile p WHERE email='".$email."'
													AND hash='".$hash."' AND verified=0 AND p.id = u.profile_id") or die(mysql_error($connection));
				$match = mysqli_num_rows($search);
				if ($match > 0) {
					
					mysqli_query($connection, "UPDATE user u, profile p SET verified=1 WHERE email='".$email."' AND hash='".$hash."'
												AND verified=0 AND p.id = u.profile_id") or die(mysqli_error($connection));
				}
				else {
					echo 'There were no results in the database with that email and hash, or it has already been verified.';
				}
			}
			else {
				echo "Either email or hash isn't set properly in URL";
			}
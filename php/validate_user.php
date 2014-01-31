<?php 
			echo "HELLO!\n";
			echo $_GET['email'];
			echo $_GET['hash'];
			echo isset($_GET['email']);
			echo !empty($_GET['email']);
			echo isset($_GET['hash']);
			echo !empty($_GET['hash']);
			
			if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
				
				$connection = mysqli_connect("localhost","root","root", "facebookcopy") or die(mysqli_error());
				
				// Verify data
				$email = mysqli_escape_string($connection, $_GET['email']); // Set email variable
				$hash = mysqli_escape_string($connection, $_GET['hash']); // Set hash variable
				
				echo $email.$hash;
				$search = mysqli_query($connection, "SELECT email, hash, active
										FROM user
										WHERE email='".$email."'
											AND hash='".$hash."'
											AND active='0'") or die(mysql_error($connection));
				echo "got here!";
				$match = mysqli_num_rows($connection, $search);
				echo "got here!2";
				if ($match > 0) {
					
					mysqli_query($connection, "UPDATE user SET active=1
								WHERE email='".$email."' AND hash='".$hash."' AND active=0") or die(mysqli_error($connection));
					echo 'Email verification success!';
				}
				else {
					echo 'Aw snap! Could not verify email.';
				}
			}
			else {
				echo 'Aw snap! Could not verify email.';
			}
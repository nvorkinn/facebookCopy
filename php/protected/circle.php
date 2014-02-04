<?PHP
	
	require ('../../includes/php-includes.php');
	class Circle {
	
		var $id;
		var $mysqli;
		var $circle_name;
		var $owner_user_id;
		
		function __construct($circle_name = NULL, $owner_user_id = 0) {
			
			// First set up object variables
			global $mysqli;
			$this->circle_name = $circle_name;
			$this->owner_user_id = $owner_user_id;
			$this->mysqli = $mysqli;
			
			// Check if the circle exists from before
			$exists_circle = "SELECT name, owner_user_id FROM circle WHERE name='$this->circle_name' AND owner_user_id = $this->owner_user_id";
			if ($result = $this->mysqli->query($exists_circle)){
				if ($result->num_rows == 0){
					
					// If circle does not exist, create new circle entry
					$insert = "INSERT INTO circle (owner_user_id, name) VALUES ($this->owner_user_id, '$this->circle_name')";
					if (!$this->mysqli->query($insert)) {
						echo "DB Error, could not create new circle in database\n";
						echo 'MySQL Error: ' . mysql_error();
						exit;
					}
					
					// Get the AUTO_INCREMENT id and set this in the object
					$this->id = $this->mysqli->insert_id;
				}
				else {
					echo "Circle already exists in database for this user\n";
				}
			}
			else {
				echo "Could not check if circle already exists in database\n";
				echo "MySQL Error: " . mysql_error();
				exit;
			}
		}
		
		function add_member($user_id = 0) {
			
			// First check if member exists
			$exists_member = "SELECT user_id FROM user_circle WHERE circle_id = $this->id AND user_id = $user_id";
			if ($result = $this->mysqli->query($exists_member)) {
				if ($result->num_rows == 0) {
					// If not, add user
					$insert = "INSERT INTO user_circle VALUES ($user_id, $this->circle_id)";
					if (!$this->mysqli->query($insert)) {
						echo "DB Error, could not create new member in circle\n";
						echo "MySQL Error: " . mysql_error();
						exit;
					}
				}
				else {
					// If user exists, just let us know
					echo "User already exists in circle";
				}
			}
			else {
				echo "Could not check if user already exists in circle\n";
				echo "MySQL Error: " . mysql_error();
				exit;
			}
		}
		
		function remove_member($user_id = 0) {
			
			// First check if user to remove exists in circle
			$exists_member = "SELECT user_id FROM user_circle WHERE circle_id = $this->id AND user_id = $user_id";
			if ($result = $this->mysqli->query($exists_member)) {
				if ($result->num_rows == 0) {
					// If user doesn't just let us know
					echo "User to remove is not member of circle. Nothing to remove\n";
				}
				else {
					// Or if user does exist, remove it
					$remove = "DELETE FROM user_circle WHERE user_id = $user_id AND circle_id = $this->id)";
					if (!$this->mysqli->query($remove)) {
						echo "DB Error, could not delete member from circle\n";
						echo "MySQL Error: " . mysql_error();
						exit;
					}
				}
			}
			else {
				echo "Could not check if user exists in circle\n";
				echo "MySQL Error: " . mysql_error();
				exit;
			}
		}
		
		function delete() {
			
			$delete_circle = "DELETE FROM circle WHERE id = $this->id";
			if (!$this->mysqli->query($delete_circle)) {
				echo "Could not delete circle from database\n";
				echo "MySQL Error: " . mysql_error();
				exit;
			}
		}
	}
	
?>	
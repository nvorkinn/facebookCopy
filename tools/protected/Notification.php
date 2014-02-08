<?PHP
    class Notification {
        var $id;
		var $activity_id;
        var $from_id;
        var $target_id;
        var $mysqli;
        
        function __construct($activity_id=NULL,$from_id=NULL,$target_id=NULL) {
            global $mysqli;
            
            $this->activity_id = $activity_id;
            $this->from_id = $from_id;
            $this->target_id = $target_id;
            $this->mysqli = $mysqli;
        }
        
        function save(){
        $query="INSERT INTO notification (activity_id, target_id, seen)VALUES ('$this->activity_id', '$this->target_id',0)";
        
        if (!$result = $this->mysqli->query($query)){
            echo "DB Error, could not query the database\n";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }
        $this->id=$this->mysqli->insert_id;
        }
        
    }
    
?>

<?PHP

    require ("vendor/autoload.php");

    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;

    class NotificationManager implements MessageComponentInterface {
        protected $clients;

        public function __construct() {
            $this->clients = array();
        }
        
        public function onOpen(ConnectionInterface $conn) {
        }

        public function onMessage(ConnectionInterface $from, $data) {	
            $obj = json_decode($data);
			if(!array_key_exists($obj->user_hash,$this->clients) && $obj->message=="INIT_MESSAGE"){
				$this->clients[$obj->user_hash]=$from;
				$from->send("INIT_SUCCESSFUL ".$obj->user_hash);
			}else{
				$target = $this->clients[$obj->target_hash];
				if(isset($target)){
					$target->send($obj->message);
				}
			}
        }

        public function onClose(ConnectionInterface $conn) {
            // The connection is closed, remove it, as we can no longer send it messages
			$key = array_search($conn,$this->clients);
			if($key==true){
			unset($this->clients[$key]);
            echo "Connection {$conn->resourceId} has disconnected\n";
			}
        }

        public function onError(ConnectionInterface $conn, \Exception $e) {
            echo "An error has occurred: {$e->getMessage()}\n";
            $conn->close();
        }        
    }

?>

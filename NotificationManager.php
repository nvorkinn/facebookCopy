<?PHP

    require ($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");

    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;

    class NotificationManager implements MessageComponentInterface {
        protected $clients;

        public function __construct() {
            $this->clients = new \SplObjectStorage;
        }
        
        public function onOpen(ConnectionInterface $conn) {
        }

        public function onMessage(ConnectionInterface $from, $data) {	
            $obj = json_decode($data);
			
            if(!$this->clients->contains($from)){
                $this->clients->attach($from, $obj->user_id);
                
            $from->send($obj->user_id);
                return;
            }
            foreach ($this->clients as $client) {
                if($this->clients[$client] == $obj->target_user_id){
                    $client->send($obj->message);
                }
            }
        }

        public function onClose(ConnectionInterface $conn) {
            // The connection is closed, remove it, as we can no longer send it messages
            $this->clients->detach($conn);
            echo "Connection {$conn->resourceId} has disconnected\n";
        }

        public function onError(ConnectionInterface $conn, \Exception $e) {
            echo "An error has occurred: {$e->getMessage()}\n";
            $conn->close();
        }        
    }

?>

<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class NotificationManager implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($_SESSION["user_id"],$conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
		$obj = json_decode($msg);
		$client = $this->clients[$obj->target_user];
		$client->send($msg);
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($_SESSION["user_id"]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }
}

?>
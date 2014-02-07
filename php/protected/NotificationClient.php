<?php
use WebSocketClient\WebSocketClientInterface;
use React\EventLoop\StreamSelectLoop;

require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');

class NotificationClient implements WebSocketClientInterface
{
	
	/** @var string $host */
    private $host;

    /** @var int $port */
    private $port;

    /** @var WebSocketClient $socket */
    private $socket;

    /** @var WebSocketClient $client */
    private $client;

    /** @var callable $onWelcomeCallback */
    private $onWelcomeCallback;

    /** @var callable $onWelcomeCallback */
    private $onEventCallback;

	/**
     * Init websocket client
     *
     * @param string $host
     * @param int $port
     */
    function __construct($host, $port)
    {
		$loop = React\EventLoop\Factory::create();
		$this->host=$host;
		$this->host=$host;
		$this->port=$port;	
        $this->socket=new WebSocketClient($this, $loop, $this->host, $this->port);
    }
	
    public function onWelcome(array $data)
    {
    }

    public function onEvent($topic, $message)
    {
    }

    public function subscribe($topic)
    {
        $this->client->subscribe($topic);
    }

    public function unsubscribe($topic)
    {
        $this->client->unsubscribe($topic);
    }

    public function call($proc, $args, Closure $callback = null)
    {
        $this->client->call($proc, $args, $callback);
    }

    public function publish($topic, $message)
    {
        $this->client->publish($topic, $message);
    }

    public function setClient(WebSocketClient $client)
    {
        $this->client = $client;
    }
	
}
?>
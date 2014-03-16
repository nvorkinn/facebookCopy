<?PHP

    require ("vendor/autoload.php");
    require_once("NotificationManager.php");

    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;

    $server = IoServer::factory(new HttpServer(new WsServer(new NotificationManager())), 8080);
    $server->run();
    
?>

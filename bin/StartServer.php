<?php

require dirname(__DIR__, 1) . "/vendor/autoload.php";

use WebSocketTutorial\MyServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Http\HttpServer;

$app = IoServer::factory(
		new HttpServer(
			new WsServer(
				new MyServer
			)
		),
		8080
	);

$app->run(); // lets test
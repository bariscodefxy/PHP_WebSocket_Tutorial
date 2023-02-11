<?php

namespace WebSocketTutorial;

use Ratchet\MessageComponentInterface; // server
use Ratchet\ConnectionInterface; // client

class MyServer implements MessageComponentInterface {

	public \SplObjectStorage $clients;

	public function __construct()
	{
		$this->clients = new \SplObjectStorage;
		echo "Server running.\n";
	}

	public function onOpen(ConnectionInterface $conn)
	{
		$this->clients->attach($conn);
		echo "Connection opened: " . $conn->remoteAddress . PHP_EOL;
	}

	public function onMessage(ConnectionInterface $from, $msg)
	{
		echo vsprintf("Received '%s' from '%s'\n", [$msg, $from->remoteAddress]);
		foreach($this->clients as $client)
		{
			$client->send($msg);
		}
	}

	public function onClose(ConnectionInterface $conn)
	{
		$this->clients->detach($conn);
		echo "Connection closed: " . $conn->remoteAddress . PHP_EOL;
	}

	public function onError(ConnectionInterface $from, \Exception $e)
	{
		// an error excepted
		$this->clients->detach($from);
	}

}
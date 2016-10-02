<?php

namespace DrawMySouffle\Network;

use Psr\Log\LoggerInterface;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Ratchet\Wamp\Exception;

class PacketRouter implements MessageComponentInterface
{
	private $routes = [];
	private $logger;


	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	function onOpen(ConnectionInterface $conn)
	{
		$this->logger->debug("Someone connected!");
	}

	function onClose(ConnectionInterface $conn)
	{
		$this->logger->debug("Someone disconnected!");
	}

	function onError(ConnectionInterface $conn, \Exception $e)
	{
		$this->logger->error($e);
	}

	function onMessage(ConnectionInterface $from, $data)
	{
		$this->logger->debug("Received data:");
		$this->logger->debug("+++" . json_encode($data, JSON_PRETTY_PRINT). "---");

		$packet = $this->getPacket($data, $from);

		if ($packet->getId()) {
			$routes = self::findRoutes($packet->getId());

			if ($routes) {
				foreach($routes as $route) {
					$route($packet);
				}
			}
		}
	}

	private function getPacket($data, $connection) : IPacket
	{
		$dataParts = explode('|', $data, 2);

		if (is_array($dataParts) && count($dataParts) > 1) {
			$packetId = $dataParts[0];
			$packetBody = json_decode($dataParts[1]);

			return new Packet($packetId, $connection, $packetBody);
		}

		$this->logger->warning("data without packet header received");
		return new NullPacket();
	}

	private function findRoutes($packetId)
	{
		if (isset($this->routes[$packetId])) {
			return $this->routes[$packetId];
		}

		return null;
	}

	public function route($packetId, callable $callback)
	{
		if (!isset($this->routes[$packetId])) {
			$this->routes[$packetId] = [];
		}

		$this->routes[$packetId][] = $callback;
	}
}
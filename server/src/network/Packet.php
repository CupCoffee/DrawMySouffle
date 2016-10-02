<?php

namespace DrawMySouffle\Network;

use Ratchet\ConnectionInterface;
use DrawMySouffle\Traits\ArrayFields;


class Packet implements IPacket
{
	use ArrayFields;

	private $id;
	private $connection;

	public function __construct($id, ConnectionInterface $connection, $body)
	{
		$this->id = $id;
		$this->connection = $connection;
	}

	public function getConnection() {
		return $this->connection;
	}

	public function getId()
	{
		return $this->id;
	}

	public function __toString()
	{
		return $this->id . '|' . json_encode($this->all());
	}
}
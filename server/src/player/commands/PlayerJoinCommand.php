<?php

namespace DrawMySouffle\Player\Commands;

use DrawMySouffle\Command\ICommand;
use DrawMySouffle\Player\Player;
use DrawMySouffle\Player\PlayerService;
use DrawMySouffle\Service\ServiceLocator;
use Ratchet\ConnectionInterface;

class PlayerJoinCommand implements ICommand
{
	public $connection;

	public $playerName;

	public function __construct(ConnectionInterface $connection, string $playerName)
	{
		$this->connection = $connection;
		$this->playerName = $playerName;
	}
}
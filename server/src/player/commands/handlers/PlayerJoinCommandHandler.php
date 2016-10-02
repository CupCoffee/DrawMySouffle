<?php

namespace DrawMySouffle\Player\Commands\Handlers;

use DrawMySouffle\Command\ICommand;
use DrawMySouffle\Command\ICommandHandler;
use DrawMySouffle\Player\IPlayerRepository;

class PlayerJoinCommandHandler implements ICommandHandler
{
	private $repository;

	public function __construct(IPlayerRepository $repository)
	{
		$this->repository = $repository;
	}

	public function execute(ICommand $command)
	{

	}
}
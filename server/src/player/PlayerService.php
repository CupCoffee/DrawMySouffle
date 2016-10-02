<?php

namespace DrawMySouffle\Player;


use DrawMySouffle\Network\IPacket;
use DrawMySouffle\Network\Packet;
use DrawMySouffle\Network\PacketRouter;
use DrawMySouffle\Network\ResponsePacket;
use DrawMySouffle\Service\IService;

class PlayerService implements IService
{
    private $repository;
	private $router;

	public function __construct(PacketRouter $router, PlayerRepository $repository)
    {
    	$this->router = $router;
        $this->repository = $repository;
    }

    public function getPlayerRepository()
    {
        return $this->repository;
    }

	public function boot()
	{
		$playerRepository = $this->repository;

		$this->router->route('PlayerConnect', function(Packet $packet) use ($playerRepository) {
			if ($packet->name) {
				if ($playerRepository->getPlayerByName($packet->name)) {

					$response = new ResponsePacket('PlayerConnect');
					$packet->error = "Name already exists";

				} else {
					$player = new Player($packet->getConnection(), $packet->name);
					$playerRepository->addPlayer($player);

					$response = new ResponsePacket('PlayerConnect');
					$response->success = true;
				}

				$packet->getConnection()->send($response);
			}
		});
	}
}
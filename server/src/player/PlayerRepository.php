<?php

namespace DrawMySouffle\Player;

use DrawMySouffle\Data\IEntity;
use DrawMySouffle\Data\Storage\IStorage;
use Ratchet\ConnectionInterface;

class PlayerRepository implements IPlayerRepository  {
	private $storage;

	public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function setStorage(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function addPlayer(Player $player)
    {
    	$this->storage->set($player->getId(), $player);
    }

    public function getPlayer($id)
    {
    	return $this->storage->get($id) ?? null;
    }

    // TODO: implement mapping system to map players by certain properties, to improve finding players by these properties
    public function getPlayerByName($name)
    {
    	foreach($this->storage->all() as $player) {
    		if ($player->name == $name)
    			return $player;
	    }

	    return null;
    }
}

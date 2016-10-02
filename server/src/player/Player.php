<?php

namespace DrawMySouffle\Player;

use DrawMySouffle\Data\Entity;
use Ramsey\Uuid\Uuid;
use Ratchet\ConnectionInterface as IConnection;

class Player extends Entity {
    private $connection;

    private $name;

    public function __construct(IConnection $connection, string $name)
    {
    	parent::__construct(Uuid::uuid4());

    	$this->connection = $connection;
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

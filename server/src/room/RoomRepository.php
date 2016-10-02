<?php

namespace DrawMySouffle\Room;

use DrawMySouffle\Data\Storage\IStorage;

class RoomRepository implements IRoomRepository  {
    protected $storage;

    public function __construct(IStorage $storage)
    {
        $this->storage = $storage;
    }

    public function setStorage(IStorage $storage)
    {
        $this->storage = $storage;
    }
}

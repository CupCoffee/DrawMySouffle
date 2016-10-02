<?php

namespace DrawMySouffle\Room;


use DrawMySouffle\Service\IService;

/**
 * Class RoomService
 * @package DrawMySouffle\Rooms
 */
class RoomService implements IService
{
    private $repository;

    public function __construct(IRoomRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getRoomRepository()
    {
        return $this->repository;
    }
}
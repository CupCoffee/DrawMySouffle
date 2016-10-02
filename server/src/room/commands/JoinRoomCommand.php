<?php

namespace DrawMySouffle\Room\Commands;

use DrawMySouffle\Command\ICommand;
use DrawMySouffle\Player\Player;

class JoinRoomCommand implements ICommand {
    private $player;

    public function __construct(Player $player)
    {
        $this->player = $player;
    }

    public function execute()
    {

    }
}

<?php

namespace DrawMySouffle\Command;


interface ICommandHandler
{
	public function execute(ICommand $command);
}
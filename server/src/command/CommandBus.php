<?php

namespace DrawMySouffle\Command;

use Exception;

class CommandBus {
	private static $bindings = [];

	private static function getCommandHandler(ICommand $command) : ICommandHandler
	{
		$className = get_class($command);

		// Check if Command is bound to a CommandHandler
		if (!isset($bindings[$className])) {
			throw new Exception("Class $className not bound to a CommandHandler");
		}

		return $bindings[$className];
	}

	public static function bind(string $commandClassName, ICommandHandler $commandHandler)
	{
		self::$bindings[$commandClassName] = $commandHandler;
	}

    public static function execute(ICommand $command)
    {
	    self::getCommandHandler($command)->execute($command);
    }
}

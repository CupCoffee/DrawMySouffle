<?php

namespace DrawMySouffle\Player;


use DrawMySouffle\Data\Storage\MemoryStorage;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class PlayerServiceProvider extends AbstractServiceProvider
{
	protected $provides = [
		'DrawMySouffle\Player\PlayerRepository',
		'DrawMySouffle\Player\PlayerService'
	];

	/**
	 * Use the register method to register items with the container via the
	 * protected $this->container property or the `getContainer` method
	 * from the ContainerAwareTrait.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->getContainer()->add('DrawMySouffle\Player\PlayerRepository')
			->withArgument('DrawMySouffle\Data\Storage\MemoryStorage');

		$this->getContainer()->add('DrawMySouffle\Player\PlayerService')
			->withArgument('DrawMySouffle\Network\PacketRouter')
			->withArgument('DrawMySouffle\Player\PlayerRepository');
	}
}
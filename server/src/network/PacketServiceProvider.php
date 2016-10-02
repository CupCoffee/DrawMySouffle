<?php

namespace DrawMySouffle\Network;

use League\Container\ServiceProvider\AbstractServiceProvider;

class PacketServiceProvider extends AbstractServiceProvider
{
	protected $provides = [
		'DrawMySouffle\Network\PacketRouter'
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
		$this->getContainer()->add('DrawMySouffle\Network\PacketRouter', new PacketRouter($this->getContainer()->get('Psr\Log\LoggerInterface')), true);
	}
}
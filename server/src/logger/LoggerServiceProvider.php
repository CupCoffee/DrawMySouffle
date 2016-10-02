<?php

namespace DrawMySouffle\Logger;

use League\Container\ServiceProvider\AbstractServiceProvider;

class LoggerServiceProvider extends AbstractServiceProvider
{
	protected $provides = [
		'Psr\Log\LoggerInterface'
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
		$this->getContainer()->add('Psr\Log\LoggerInterface', new Logger);
	}
}
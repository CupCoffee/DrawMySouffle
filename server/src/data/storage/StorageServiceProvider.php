<?php

namespace DrawMySouffle\Data\Storage;


use League\Container\ServiceProvider\AbstractServiceProvider;

class StorageServiceProvider extends AbstractServiceProvider
{
	protected $provides = [
		'DrawMySouffle\Data\Storage\IStorage',
		'DrawMySouffle\Data\Storage\MemoryStorage'
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
		$this->getContainer()->add('DrawMySouffle\Data\Storage\IStorage', new MemoryStorage());
		$this->getContainer()->add('DrawMySouffle\Data\Storage\MemoryStorage', new MemoryStorage());
	}
}
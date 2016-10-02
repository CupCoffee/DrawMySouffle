<?php

namespace DrawMySouffle\Service;

use Exception;

class ServiceLocator
{
    protected static $services = [];

    public static function provide(string $class, IService $service)
    {
        if (isset(self::$services[$class])) {
            throw new Exception("A service with class $class has already been registered to the service locator");
        }

        self::$services[$class] = $service;
    }


    public static function locate(string $class)
    {
        if (isset(self::$services[$class])) {
            return self::$services[$class];
        } else {
            throw new Exception("A service with class $class has not been registered to the service locator");
        }
    }

	/**
	 * Use the register method to register items with the container via the
	 * protected $this->container property or the `getContainer` method
	 * from the ContainerAwareTrait.
	 *
	 * @return void
	 */
	public function register()
	{
		// TODO: Implement register() method.
	}
}
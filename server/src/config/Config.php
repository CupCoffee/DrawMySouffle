<?php

class Config
{
	private static $instances = [];

	const CONFIG_BASE_PATH = __DIR__ . '/../../config';

	private $namespace;

	private $data;

	public function __construct(string $namespace)
	{
		$this->namespace = $namespace;

		$this->loadFile();
	}

	public function __invoke($namespace) : Config
	{
		if (!isset(self::$instances[$namespace])) {
			self::$instances[$namespace] = new Config($namespace);
		}

		return self::$instances[$namespace];
	}


	private function loadFile()
	{
		$path = realpath(self::CONFIG_BASE_PATH . "/$this->namespace.php");

		if (!$path) {
			throw new Exception("Invalid path with namespace $this->namespace");
		}

		$this->data = require $path;
	}

	public function get($key)
	{
		if (is_array($this->data) && isset($this->data[$key])) {
			return $this->data[$key];
		}

		return null;
	}

	public function all()
	{
		return $this->data;
	}
}
<?php

namespace DrawMySouffle\Data\Storage;

class MemoryStorage implements IStorage {
	private $storage;

    public function __construct()
    {
        $this->storage = [];
    }

	public function get($key)
	{
		if (isset($this->storage[$key])) {
			return $this->storage[$key];
		}
	}

	public function set($key, $value)
	{
		$this->storage[$key] = $value;
	}

	public function delete($key)
	{
		unset($this->storage[$key]);
	}

	public function all()
	{
		return $this->storage;
	}
}

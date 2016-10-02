<?php

namespace DrawMySouffle\Traits;

trait ArrayFields
{
	private $fields;

	public function __get($key)
	{
		if (isset($this->fields[$key]))
			return $this->fields[$key];
		else
			return null;
	}

	public function __set($key, $value)
	{
		$this->fields[$key] = $value;
	}

	public function all()
	{
		return $this->fields;
	}
}
<?php

namespace DrawMySouffle\Data\Registry;

interface IRegistry
{
	public function get($key);

	public function set($key, $value);
}
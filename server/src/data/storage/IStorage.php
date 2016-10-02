<?php

namespace DrawMySouffle\Data\Storage;

interface IStorage {
    public function get($key);

    public function set($key, $value);

    public function delete($key);

	public function all();
}

<?php

namespace DrawMySouffle\Data;

use DrawMySouffle\Data\Storage\IStorage;

interface IRepository {
    public function setStorage(IStorage $storage);
}

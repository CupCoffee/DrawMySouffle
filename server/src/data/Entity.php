<?php

namespace DrawMySouffle\Data;

use Ramsey\Uuid\Uuid;

class Entity {
    private $id;

    public function __construct($id = null)
    {
        if (!$id) {
            $id = Uuid::uuid4()->toString();
        }

        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}

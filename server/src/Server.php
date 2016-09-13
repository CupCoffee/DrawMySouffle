<?php

namespace DrawMySouffle;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\WampServerInterface

class Server implements WampServerInterface {
    public function onPublish(ConnectionInterface $connection, $topic, $event, array $exclude, array $eligible)
    {
    }
}

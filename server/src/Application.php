<?php

namespace DrawMySouffle;

use Ratchet\App;
use Server;


class Application {
    private $server;

    public function __construct()
    {
        $this->server = new App('localhost');
        $this->server->route('/pubsub', new Server);
    }

    public function start()
    {
        $server->run();
    }
}

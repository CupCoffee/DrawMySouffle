<?php

namespace DrawMySouffle;

use Ratchet\App;
use DrawMySouffle\Server;
use Ratchet\Server\EchoServer;

class Application {
    private $server;

    public function __construct()
    {
        $this->server = new App();
        $this->server->route('/game', new Server);
    }

    public function start()
    {
        $this->server->run();
    }
}

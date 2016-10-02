<?php

namespace DrawMySouffle;

use DrawMySouffle\Data\Storage\StorageServiceProvider;
use DrawMySouffle\Logger\LoggerServiceProvider;
use DrawMySouffle\Network\PacketServiceProvider;
use DrawMySouffle\Player\PlayerServiceProvider;
use DrawMySouffle\Service\IService;
use League\Container\Container;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

class Application {
	private $container;

    private $server;

	private $services = [
		'DrawMySouffle\Player\PlayerService',
	];

    public function __construct()
    {
        $this->container = new Container();
    	$this->registerServiceProviders();
    }

    private function registerServiceProviders()
    {
    	$this->container->addServiceProvider(new StorageServiceProvider);
    	$this->container->addServiceProvider(new LoggerServiceProvider);
	    $this->container->addServiceProvider(new PacketServiceProvider);

	    $this->container->addServiceProvider(new PlayerServiceProvider);
    }

    private function bootServices()
    {
    	foreach($this->services as $service) {
    		$service = $this->container->get($service);

		    if ($service instanceof IService) {
			    $service->boot();
		    }
	    }
    }


    public function start()
    {
    	$packetRouter = $this->container->get('DrawMySouffle\Network\PacketRouter');
	    $this->server = new WsServer($packetRouter);

	    $this->bootServices();

	    $server = IoServer::factory(new HttpServer($this->server), 8080);
	    $server->run();
    }
}

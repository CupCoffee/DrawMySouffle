<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 20-9-2016
 * Time: 23:10
 */

namespace DrawMySouffle\Event;


use DrawMySouffle\Event\IEvent;

interface IEventHandler
{
	public function handle(IEvent $event);
}
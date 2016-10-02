<?php

namespace DrawMySouffle\Network;

interface IPacket
{
	public function getId();

	public function __toString();
}
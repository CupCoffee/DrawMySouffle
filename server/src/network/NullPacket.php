<?php

namespace DrawMySouffle\Network;

class NullPacket implements IPacket
{
	public function getId()
	{
		return null;
	}
}
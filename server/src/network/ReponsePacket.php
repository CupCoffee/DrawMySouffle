<?php
/**
 * Created by PhpStorm.
 * User: Leroy
 * Date: 29-9-2016
 * Time: 21:59
 */

namespace DrawMySouffle\Network;

use DrawMySouffle\Traits\ArrayFields;

class ResponsePacket implements IPacket
{
	use ArrayFields;

	private $id;

	public function __construct($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function __toString()
	{
		return $this->id . '|' . json_encode($this->all());
	}
}
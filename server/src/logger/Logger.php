<?php

namespace DrawMySouffle\Logger;

use League\CLImate\CLImate;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
	private $climate;

	public function __construct()
	{
		$this->climate = new CLImate();
	}

	/**
	 * System is unusable.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function emergency($message, array $context = array())
	{
		return $this->climate->backgroundRed($message);
	}

	/**
	 * Action must be taken immediately.
	 *
	 * Example: Entire website down, database unavailable, etc. This should
	 * trigger the SMS alerts and wake you up.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function alert($message, array $context = array())
	{
		return $this->climate->backgroundYellow($message);
	}

	/**
	 * Critical conditions.
	 *
	 * Example: Application component unavailable, unexpected exception.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function critical($message, array $context = array())
	{
		return $this->climate->red($message);
	}

	/**
	 * Runtime errors that do not require immediate action but should typically
	 * be logged and monitored.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function error($message, array $context = array())
	{
		return $this->climate->backgroundLightRed($message);
	}

	/**
	 * Exceptional occurrences that are not errors.
	 *
	 * Example: Use of deprecated APIs, poor use of an API, undesirable things
	 * that are not necessarily wrong.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function warning($message, array $context = array())
	{
		return $this->climate->yellow($message);
	}

	/**
	 * Normal but significant events.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function notice($message, array $context = array())
	{
		return $this->climate->lightBlue($message);
	}

	/**
	 * Interesting events.
	 *
	 * Example: User logs in, SQL logs.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function info($message, array $context = array())
	{
		return $this->climate->green($message);
	}

	/**
	 * Detailed debug information.
	 *
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function debug($message, array $context = array())
	{
		return $this->climate->backgroundLightMagenta($message);
	}

	/**
	 * Logs with an arbitrary level.
	 *
	 * @param mixed $level
	 * @param string $message
	 * @param array $context
	 *
	 * @return null
	 */
	public function log($level, $message, array $context = array())
	{
		if (method_exists($this, $level)) {
			$this->$level($message, $context);
		} else {
			$this->climate->out($message);
		}
	}
}
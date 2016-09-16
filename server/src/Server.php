<?php

namespace DrawMySouffle;

use Ratchet\ConnectionInterface;
use Ratchet\Wamp\Topic;
use Ratchet\Wamp\WampServerInterface;

class Server implements WampServerInterface {
    public function onPublish(ConnectionInterface $connection, $topic, $event, array $exclude, array $eligible)
    {
    }

	/**
	 * When a new connection is opened it will be passed to this method
	 * @param  ConnectionInterface $conn The socket/connection that just connected to your application
	 * @throws \Exception
	 */
	function onOpen(ConnectionInterface $conn)
	{
		echo "Someone connected!";
	}

	/**
	 * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
	 * @param  ConnectionInterface $conn The socket/connection that is closing/closed
	 * @throws \Exception
	 */
	function onClose(ConnectionInterface $conn)
	{
		// TODO: Implement onClose() method.
	}

	/**
	 * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
	 * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
	 * @param  ConnectionInterface $conn
	 * @param  \Exception $e
	 * @throws \Exception
	 */
	function onError(ConnectionInterface $conn, \Exception $e)
	{
		// TODO: Implement onError() method.
	}

	/**
	 * An RPC call has been received
	 * @param \Ratchet\ConnectionInterface $conn
	 * @param string $id The unique ID of the RPC, required to respond to
	 * @param string|Topic $topic The topic to execute the call against
	 * @param array $params Call parameters received from the client
	 */
	function onCall(ConnectionInterface $conn, $id, $topic, array $params)
	{
		// TODO: Implement onCall() method.
	}

	/**
	 * A request to subscribe to a topic has been made
	 * @param \Ratchet\ConnectionInterface $conn
	 * @param string|Topic $topic The topic to subscribe to
	 */
	function onSubscribe(ConnectionInterface $conn, $topic)
	{
		echo "Someone subscribed to " . $topic->getId();
	}

	/**
	 * A request to unsubscribe from a topic has been made
	 * @param \Ratchet\ConnectionInterface $conn
	 * @param string|Topic $topic The topic to unsubscribe from
	 */
	function onUnSubscribe(ConnectionInterface $conn, $topic)
	{
		// TODO: Implement onUnSubscribe() method.
	}
}

import _ from "underscore";

export default class Socket {
	static connect()
	{
		this._isConnected = false;

		this.on(this.OPEN).then(function () {
			this._isConnected = true;
		}.bind(this));

		this._socket = new WebSocket("ws://localhost:8080");

		this._socket.onopen = this._handleEvent.bind(this);
		this._socket.onmessage = this._handleEvent.bind(this);
		this._socket.onerror = this._handleEvent.bind(this);
		this._socket.onclose = this._handleEvent.bind(this);
	}

	/**
	 * @return {string}
	 */
	static get OPEN()
	{
		return "open";
	}

	/**
	 * @return {string}
	 */
	static get MESSAGE()
	{
		return "message";
	}

	/**
	 * @return {string}
	 */
	static get ERROR()
	{
		return "error";
	}

	/**
	 * @return {string}
	 */
	static get CLOSE()
	{
		return "close";
	}

	static _handleEvent(event)
	{
		// FIXME: this is duplicate code
		if (!this._listeners) {
			this._listeners = {};
		}

		if (event.type in this._listeners) {
			_.each(this._listeners[event.type], function({resolve, reject}) {
				resolve(event);
			});
		}
	}

	static isConnected()
	{
		return this._isConnected;
	}

	static send(data)
	{
		if (this.isConnected()) {
			if (!_.isString(data)) {
				data = JSON.stringify(data);
			}

			this._socket.send(data);
		} else {
			console.error("Socket not connected!");
		}
	}

	static on(eventType)
	{
		// FIXME: this is duplicate code
		if (!this._listeners) {
			this._listeners = {};
		}

		if (!(eventType in this._listeners)) {
			this._listeners[eventType] = [];
		}

		return new Promise(function(resolve, reject) {
			this._listeners[eventType].push({
				resolve: resolve,
				reject: reject
			});
		}.bind(this));
	}
}
import Socket from "./Socket";

export default class Packet {
	constructor(id)
	{
		this.id = id;
	}

	send()
	{
		console.log(`${this.id}|${JSON.stringify(this)}`);

		if (Socket.isConnected()) {
			Socket.send(`${this.id}|${JSON.stringify(this)}`);

			return new Promise(function(resolve, reject) {
				Socket.on(Socket.MESSAGE).then(function(event) {
					if (event.data.indexOf('|') >= 0) {
						let splitData = event.data.split('|');
						let packetId = splitData[0];

						if (this.id == packetId) {
							let data = JSON.parse(splitData[1]);
							let responsePacket = new Packet(packetId);

							resolve(_.extend(responsePacket, data));
						}
					}
				});
			}.bind(this));
		} else {
			console.error("Trying to send packet while not connected!");
		}
	}
}
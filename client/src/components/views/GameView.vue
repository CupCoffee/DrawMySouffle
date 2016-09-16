<template>
	<drawing-canvas></drawing-canvas>
</template>
<style>

</style>
<script>
	import DrawingCanvas from "../game/DrawingCanvas.vue";
	import Wampy from 'wampy';

	import { socket, roomId } from "../../vuex/getters";
	import { setRoomId } from "../../vuex/actions";

    export default {
		components: {
			'drawing-canvas': DrawingCanvas
		},

	    ready: function() {
			this.setRoomId(this.$route.params.roomId);

			this.socket.subscribe(`room.${this.roomId}`);
	    },

		vuex: {
			actions: {
				setRoomId
			},
			getters: {
				socket,
				roomId
			}
		},
    }
</script>

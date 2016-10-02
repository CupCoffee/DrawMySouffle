<template>
	<drawing-canvas></drawing-canvas>
</template>
<style>

</style>
<script>
	import DrawingCanvas from "../game/DrawingCanvas.vue";

	import { roomId } from "../../vuex/getters";
	import { setRoomId } from "../../vuex/actions";
	import Socket from "../../network/Socket";
	import Packet from "../../network/Packet";

    export default {
		components: {
			'drawing-canvas': DrawingCanvas
		},

	    ready: function() {
			this.setRoomId(this.$route.params.roomId);
	    },

		methods: {

		},

		vuex: {
			actions: {
				setRoomId
			},
			getters: {
				roomId
			}
		},
    }
</script>

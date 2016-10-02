import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

import {Store} from "vuex";

export default new Store({
	state: {
		socket: null,
		roomId: null
	},

	mutations: {
		SET_ROOM_ID(state, roomId) {
			state.roomId = roomId;
		},
	}
});
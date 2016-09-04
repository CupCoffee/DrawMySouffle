import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import AppComponent from "./components/App.vue";

import GameViewComponent from "./components/views/GameView.vue";

let app = Vue.extend(AppComponent);
let router = new VueRouter({
	history: true
});

router.map({
	'/:gameId': {
		component: GameViewComponent
	}
});

router.start(app, "#app");
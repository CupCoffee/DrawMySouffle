import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import AppComponent from "./components/App.vue";

import LoadingViewComponent from "./components/views/LoadingView.vue";
import GameViewComponent from "./components/views/GameView.vue";
import RegisterViewComponent from "./components/views/RegisterView.vue";
import Socket from "./network/Socket";

let app = Vue.extend(AppComponent);
let router = new VueRouter({
	history: true
});

router.map({
	'/': {
		component: LoadingViewComponent
	},
	'join': {
		component: RegisterViewComponent
	},
	'/:roomId': {
		component: GameViewComponent
	},
});

router.beforeEach(function({to, next}) {
	if (!Socket.isConnected()) {
		Socket.on(Socket.OPEN).then(function(event) {
			console.log(to.path);
			if (to.path != '/') {
				router.go(to.path);
			} else {
				router.go('/randomroomnamehere');
			}

		}, function(rejection) {
			console.error(rejection);
		});

		Socket.connect();
		if (to.path == '/') {
			next();
		} else {
			router.go('/');
		}
	} else {
		next();
	}
});

router.start(app, "#app");
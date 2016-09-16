<template>
	<main class="main">
		<router-view></router-view>
	</main>
</template>
<style lang="sass">
	body {
		margin: 0;
		overflow: hidden;
	}
</style>
<script>
	import { getSocket } from "../vuex/getters";
	import { setSocket } from "../vuex/actions";
	import store from "../vuex/store";

	import Wampy from "wampy";

	export default {
		store,

		ready() {
			this.setSocket(new Wampy('ws://localhost:8080/game', {
				realm: 'game'
			}));
		},

		vuex: {
			actions: {
				setSocket
			},
		}
	}
</script>

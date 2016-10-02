<template>
	<main class="main">
		<router-view></router-view>
	</main>
</template>
<script>
	import store from "../vuex/store";

	export default {
		store,

		ready() {
		},

		vuex: {
		}
	}
</script>

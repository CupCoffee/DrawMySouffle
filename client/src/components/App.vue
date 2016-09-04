<template>
	<main class="main">
		<router-view></router-view>
	</main>
</template>
<style lang="sass">
	body {
		margin: 0;
	}
</style>
<script>
	export default {
		data: function() {
			return {

			}
		},

		methods: {
			click: function() {
				console.log("CLICK");
			}

		},
	}
</script>

<template>
	<section class="view view--background">
		<div class="row screen-height align-middle align-center">
			<div>
				<h1 class="logo">
        <span class="logo__part">
            Draw
        </span><span class="logo__part">
            My
        </span><img class="logo__part" src="/assets/Souffle-icon.png">
				</h1>
				<form class="form small-12">
					<fieldset class="form__field">
						<input class="input input--text" type="text" v-model="playerName">
					</fieldset>
					<fieldset class="form__submit">
						<button class="input input--button input--button--submit" type="button" @click="playerJoin">
							<i class="icon-paint-brush"></i>
						</button>
					</fieldset>
				</form>
			</div>
		</div>
	</section>
</template>
<script>
	import Packet from "../../network/Packet";

	export default {
		data() {
			return {
				playerName: null
			};
		},
		methods: {
			playerJoin() {
				if (this.playerName) {
					let playerJoinPacket = new Packet('PlayerJoin');
					playerJoinPacket.name = this.playerName;
					playerJoinPacket.send().then(function(packet) {
						console.log(packet);
					});
				}
			}
		}
	}
</script>

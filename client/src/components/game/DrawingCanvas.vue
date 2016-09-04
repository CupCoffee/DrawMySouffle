<template>
	<canvas :width="width" :height="height" v-el:canvas @mousedown="onMouseDown" @mousemove="onMouseMove"
	        @mouseup="onMouseUp"></canvas>
</template>
<script>
	import PIXI from "pixi.js";
	import Pencil from "../../game/Pencil";

	export default {
		props: {
			'width': {
				default: window.innerWidth
			},
			'height': {
				default: window.innerHeight
			},
		},

		ready: function ()
		{
			this.gfx = this.$els.canvas.getContext('2d');

			this.pencil = new Pencil(this.gfx);

			// Start the render loop
//			this.loop();
		},

		methods: {
			loop: function ()
			{
				this.render();
				requestAnimationFrame(this.loop.bind(this));
			},

			render: function ()
			{
				this.renderer.render(this.stage);
			},

			onMouseDown: function (event)
			{
				this.pencil.startDrawing(event.pageX, event.pageY);
			},

			onMouseMove: function (event)
			{
				this.pencil.draw(event.pageX, event.pageY);
			},

			onMouseUp: function (event)
			{
				this.pencil.stopDrawing(event.pageX, event.pageY);
			}
		}
	}
</script>

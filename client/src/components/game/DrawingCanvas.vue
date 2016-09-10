<template>
<canvas class="drawing-canvas" :width="width" :height="height" v-el:canvas></canvas>
<canvas class="drawing-canvas" :width="width" :height="height" v-el:pencilcanvas @mousedown="onMouseDown" @mousemove="onMouseMove" @mouseup="onMouseUp" @blur="onMouseUp"></canvas>

<colorpicker class="toolbox" @color-pick="setCurrentColor"></colorpicker>
<sizepicker class="toolbox" @size-pick="setCurrentSize"></sizepicker>
</template>
<style>
.drawing-canvas {
	position: absolute;
	z-index: 0;
}

.toolbox {
	position: relative;
	z-index: 1;
}
</style>
<script>
import ColorpickerComponent from "./Colorpicker.vue";
import SizepickerComponent from "./Sizepicker.vue";


import Pencil from "../../game/Pencil.js";

export default {
	props: {
		'width': {
			default: window.innerWidth
		},
		'height': {
			default: window.innerHeight
		},
		'pencil': {
			default: null
		}
	},

	ready: function() {
		this.canvasCtx = this.$els.canvas.getContext('2d');
		this.pencilCanvasCtx = this.$els.pencilcanvas.getContext('2d');

		this.pencil = new Pencil(this.pencilCanvasCtx);
	},

	methods: {
		onMouseDown: function(event) {
			// If the left mouse button is pressed
			if (event.button === 0)
				this.pencil.startDrawing(event.pageX, event.pageY);
		},

		onMouseMove: function(event) {
			this.pencil.draw(event.pageX, event.pageY);
		},

		onMouseUp: function(event) {
			this.pencil.stopDrawing(event.pageX, event.pageY);

			let imageData = this.pencilCanvasCtx.getImageData(0, 0, this.width, this.height);
			createImageBitmap(imageData).then(function(image) {
				this.canvasCtx.drawImage(image, 0, 0);
			}.bind(this))
		},

		setCurrentColor(color)
		{
			this.pencil.setColor(color);
		},

		setCurrentSize(size)
		{
			this.pencil.setSize(size);
		},
	},

	components: {
		colorpicker: ColorpickerComponent,
		sizepicker: SizepickerComponent
	}
}
</script>

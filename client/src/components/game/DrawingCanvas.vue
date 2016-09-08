<template>
<canvas class="drawing-canvas" :width="width" :height="height" v-el:canvas></canvas>
<canvas class="drawing-canvas" :width="width" :height="height" v-el:pencilcanvas @mousedown="onMouseDown" @mousemove="onMouseMove" @mouseup="onMouseUp" @blur="onMouseUp"></canvas>
<canvas class="drawing-canvas drawing-canvas--renderer" :width="width" :height="height" v-el:rendercanvas></canvas>

<colorpicker class="toolbox" @color-pick="setCurrentColor"></colorpicker>
<sizepicker class="toolbox" @size-pick="setCurrentSize"></sizepicker>
</template>
<style>
.drawing-canvas {
	position: absolute;
	z-index: 0;
}

.drawing-canvas--renderer {
	pointer-events: none;
}

.toolbox {
	position: relative;
	z-index: 1;
}
</style>
<script>
import OrbitControls from "three-orbit-controls";

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

		this.pencil = new Pencil(this.pencilCanvasCtx, 100, 100);

		this.initThree();
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

		initThree()
		{
			this.scene = new THREE.Scene();

		    this.camera = new THREE.PerspectiveCamera( 75, this.width / this.height, 1, 10000 );
		    this.camera.position.z = 1000;

			let material = new THREE.MeshLambertMaterial( { color:0xFF00FF, shading: THREE.FlatShading } );

			let loader = new THREE.JSONLoader();

			loader.load("/assets/pencil.json", function(geometry) {
				this.pencilModel = new THREE.Mesh(geometry, material);
				this.scene.add(this.pencilModel);

				this.pencilModel.scale.x = this.pencilModel.scale.y = this.pencilModel.scale.z = 100;

				this.renderThree();
			}.bind(this));

			this.scene.add(new THREE.AmbientLight(0x404040 ));

		    this.renderer = new THREE.WebGLRenderer({
				canvas: this.$els.rendercanvas,
				alpha: true
			});

		    this.renderer.setSize(this.width, this.height);
		},

		renderThree()
		{
			this.pencilModel.position.set(this.pencil.position.x, (this.pencil.position.y + this.height / 2) - this.height, 0);
			this.renderer.render(this.scene, this.camera);

			requestAnimationFrame(this.renderThree.bind(this));
		}
	},

	components: {
		colorpicker: ColorpickerComponent,
		sizepicker: SizepickerComponent
	}
}
</script>

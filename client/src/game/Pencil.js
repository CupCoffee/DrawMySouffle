import Color from "../util/Color";

export default class Pencil {
	/**
	 * @var gfx {CanvasContext2d}
	 */

	constructor(canvasContext) {
		this.gfx = canvasContext;

		this.gfx.lineCap = 'round';
		this.gfx.lineJoin = 'round';
		this.setSize(20);

		this.linePoints = [];

		this.patternImage = new Image();
		this.patternImage.src = '/assets/paper.png';
		this.patternImage.onload = function () {
			this.setColor('#000000');
		}.bind(this);

		this.colorFilterCanvas = document.createElement("canvas");

		this._isDrawing = false;
	}

	_filterImageColor(image, color) {
		this.colorFilterCanvas.width = image.width;
		this.colorFilterCanvas.height = image.height;

		let colorFilterContext = this.colorFilterCanvas.getContext('2d');
		colorFilterContext.globalCompositeOperation = 'overlay';
		colorFilterContext.clearRect(0, 0, image.width, image.height);
		colorFilterContext.drawImage(image, 0, 0);

		let rgb = Color.hexToRgb(color);

		// colorFilterContext.fillStyle = `rgba(${rgb.r}, ${rgb.g}, ${rgb.b}, 0.7)`;
		colorFilterContext.fillStyle = color;
		colorFilterContext.fillRect(0, 0, image.width, image.height);
		return colorFilterContext.getImageData(0, 0, image.width, image.height);
	}

	isDrawing() {
		return this._isDrawing;
	}

	startDrawing(x, y) {
		this._isDrawing = true;

		this.addLinePoint(x, y);
	}

	draw(x, y) {
		if (!this.isDrawing()) return;

		this.gfx.clearRect(0, 0, this.gfx.canvas.width, this.gfx.canvas.height);
		this.addLinePoint(x, y);

		this.gfx.beginPath();
		this.gfx.moveTo(this.linePoints[0].x, this.linePoints[0].y);

		let p1 = this.linePoints[0];
		let p2 = this.linePoints[1];

		for (let i = 1, len = this.linePoints.length; i < len; i++) {
			let midPoint = {
				x: p1.x + (p2.x - p1.x) / 2,
				y: p1.y + (p2.y - p1.y) / 2
			};

			this.gfx.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
			p1 = this.linePoints[i];
			p2 = this.linePoints[i + 1];
		}

		this.gfx.lineTo(p1.x, p1.y);

		this.gfx.stroke();
	}

	stopDrawing(x, y) {
		this.clearLinePoints();
		this._isDrawing = false;
	}

	addLinePoint(x, y) {
		this.linePoints.push({
			x: x,
			y: y
		});
	}

	clearLinePoints() {
		this.linePoints = [];
	}

	setColor(color) {
		createImageBitmap(this._filterImageColor(this.patternImage, color)).then(function(image) {
			this.gfx.strokeStyle = this.gfx.createPattern(image, 'repeat');
		}.bind(this))
	}

	setSize(size) {
		this.gfx.lineWidth = size;
	}
}

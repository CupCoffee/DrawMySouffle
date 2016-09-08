export default class Pencil {
	/**
	 * @var gfx {CanvasContext2d}
	 */

	constructor(canvasContext, x, y)
	{
		this.gfx = canvasContext;

		this.gfx.lineCap = 'round';
		this.gfx.lineJoin = 'round';

		this.linePoints = [];

		this.position = new THREE.Vector2(x, y);

		this._isDrawing = false;
	}

	isDrawing()
	{
		return this._isDrawing;
	}

	startDrawing(x, y)
	{
		this._isDrawing = true;

		this.addLinePoint(x, y);
	}

	draw(x, y)
	{
		this.position.set(x, y);

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
			p2 = this.linePoints[i+1];
		}

		this.gfx.lineTo(p1.x, p1.y);

		this.gfx.stroke();
	}

	stopDrawing(x, y)
	{
		this.clearLinePoints();
		this._isDrawing = false;
	}

	addLinePoint(x, y)
	{
		this.linePoints.push({
			x: x,
			y: y
		});
	}

	clearLinePoints()
	{
		this.linePoints = [];
	}

	setColor(color)
	{
		this.gfx.strokeStyle = color.toString();
	}

	setSize(size)
	{
		this.gfx.lineWidth = size;
	}
}

export default class Pencil {
	constructor(gfx)
	{
		this.gfx = gfx;
		
		this.gfx.lineCap = 'round';
		this.gfx.lineJoin = 'round';
		this.gfx.lineWidth = '10px';
		this.gfx.lineColor = 'black';

		this.linePoints = [];

		this._isDrawing = false;
	}

	isDrawing()
	{
		return this._isDrawing;
	}

	startDrawing(x, y)
	{
		this._isDrawing = true;
		this.linePoints.push({
			x: x,
			y: y
		});
	}

	draw(x, y)
	{
		if (!this.isDrawing()) return;

		this.line.clear();
		this.line.lineStyle(10, 0xFF00FF, 1);
		this.line.moveTo(x, y);
		this.linePoints.push(new PIXI.Point(x, y));

		var p1 = this.linePoints[0];
		var p2 = this.linePoints[1];

		for (var i = 1, len = this.linePoints.length; i < len; i++) {
			var midPoint = {
				x: p1.x + (p1.x - p2.x) / 2,
				y: p1.y + (p1.y - p2.y) / 2
			};

			this.line.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
			p1 = this.linePoints[i];
			p2 = this.linePoints[i+1];
		}

		this.line.lineTo(p1.x, p1.y);
		this.line.endFill();
	}

	stopDrawing(x, y)
	{
		this.linePoints = [];
		this._isDrawing = false;
	}

	getLine()
	{
		return this.line;
	}
}
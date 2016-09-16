var path = require('path');

module.exports = {
	node: {
		net: "empty",
		tls: "empty",
		fs: "empty"
	},
	entry: path.resolve(__dirname, 'src/app.js'),
	output: {
		path: path.resolve(__dirname, 'build'),
		filename: 'app.js'
	},
	watch: true,
	module: {
		postLoaders: [
			{
				include: path.resolve(__dirname, 'node_modules/pixi.js'),
				loader: 'ify'
			}
		],
		loaders: [
			{test: /\.js$/, loader: "babel", exclude: /node_modules/},
			{test: /\.scss$/, loader: "style!css!sass"},
			{test: /\.vue$/, loader: "vue"},
			{test: /\.json$/, loader: "json"},
		]
	},
	vue: {
		loaders: {
			js: 'babel'
		}
	},
	babel: {
		presets: ['es2015']
	}
};
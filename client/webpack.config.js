var path = require('path');
var webpack = require('webpack');
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
	node: {
		net: "empty",
		tls: "empty",
		fs: "empty"
	},
	devtool: 'source-map',
	entry: [
		path.resolve(__dirname, 'src/app.js'),
		path.resolve(__dirname, 'scss/style.scss'),
	],
	output: {
		path: path.resolve(__dirname, 'build'),
		filename: 'app.js'
	},
	watch: true,
	module: {
		loaders: [
			{test: /\.js$/, loader: "babel", exclude: /node_modules/},
			{test: /\.scss$/, loader: ExtractTextPlugin.extract(['css?sourceMap', 'sass?sourceMap'])},
			{test: /\.vue$/, loader: "vue"},
			{test: /\.json$/, loader: "json"},
		]
	},
	plugins: [
		new webpack.optimize.OccurenceOrderPlugin(),
		new webpack.HotModuleReplacementPlugin(),
		new webpack.NoErrorsPlugin(),
		new ExtractTextPlugin('style.css', {
			allChunks: true
		}),
	],
	vue: {
		loaders: {
			js: 'babel'
		}
	},
	babel: {
		presets: ['es2015']
	},
	sassLoader: {
		includePaths: [path.resolve(__dirname, "node_modules")]
	}
};
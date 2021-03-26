const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const FriendlyErrorsWebpackPlugin = require('friendly-errors-webpack-plugin');
const targetPath = '../assets/scripts';
const basePath = __dirname;
const targetFolder = 'build';

module.exports = {
	entry: {
		theme: [
			path.resolve('assets/scripts/src/theme', 'theme.js'),
			path.resolve('assets/styles/src', 'style.scss'),
		],
		'archive-product': [
			path.resolve('assets/scripts/src/archive', 'product.js'),
		],
	},
	output: {
		filename: 'scripts/build/[name].bundle.js',
		path: path.resolve(__dirname, '../assets'),
		publicPath: '/',
	},
	stats: 'errors-only',
	externals: {
		jquery: 'jQuery',
		react: 'React',
		'react-dom': 'ReactDOM',
		// slick: 'slick',
	},
	module: {
		rules: [
			// perform js babelization on all .js files
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['babel-preset-env'],
					},
				},
			},
			{
				test: /\.(png|jpg)$/,
				loader: 'file-loader',
				options: {
					name: '[name].[ext]',
					outputPath: 'assets/images',
				},
			},
			{
				test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '[name].[ext]',
							outputPath: 'assets/fonts',
						},
					},
				],
			},
		],
	},
	plugins: [
		new FriendlyErrorsWebpackPlugin(),
		new CleanWebpackPlugin([targetFolder], {
			root: basePath + '/' + targetPath,
		}),
		// extract css into dedicated file
		new StyleLintPlugin({
			files: './assets/styles/**/*.s?(a|c)ss',
			fix: true,
			failOnError: false,
			syntax: 'scss',
		}),
		new MiniCssExtractPlugin({
			filename: '../style.css',
		}),
	],
	devtool: 'cheap-module-source-map',
};

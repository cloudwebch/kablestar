const { merge } = require('webpack-merge');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require('autoprefixer');
const PostCSSMixins = require('postcss-mixins');
const PostCSSNested = require('postcss-nested');
const PostCSSSimpleVars = require('postcss-simple-vars');
const CSSMQpacker = require('css-mqpacker');
const PixRem = require('pixrem');
const common = require('./common');

module.exports = merge(common, {
	mode: 'development',
	devtool: 'source-map',
	module: {
		rules: [
			...common.module.rules,
			// compile all .scss files to plain old css
			{
				test: /\.s[c|a]ss$/,
				use: [
					MiniCssExtractPlugin.loader,
					{
						loader: 'css-loader',
						options: { sourceMap: true, url: false },
					},
					{
						loader: 'postcss-loader',
						options: {
							ident: 'postcss',
							sourceMap: true,
							plugins: () => [
								autoprefixer(),
								PostCSSNested(),
								PostCSSSimpleVars(),
								PostCSSMixins(),
								CSSMQpacker({
									sort: true,
								}),
								PixRem({
									atrules: true,
									replace: false,
								}),
							],
						},
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: true,
							outputStyle: 'nested',
						},
					},
				],
			},
		],
	},
	optimization: {
		minimize: false,
	},
});

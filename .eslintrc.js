module.exports = {
	parser: 'babel-eslint',
	extends: [
		'plugin:@wordpress/eslint-plugin/recommended',
		'plugin:prettier/recommended',
	],
	plugins: ['@wordpress', 'prettier'],
	env: {
		browser: true,
		jquery: true,
		es6: true,
		node: true,
		commonjs: true,
	},
	globals: {
		console: true,
		document: true,
		window: true,
		wp: 'readonly',
	},
	parserOptions: {
		ecmaVersion: 2018,
		sourceType: 'module',
		ecmaFeatures: {
			modules: true,
			jsx: true,
		},
	},
	rules: {
		'no-console': 'off',
		'valid-jsdoc': 'off',
		'prettier/prettier': 'error',
	},
};

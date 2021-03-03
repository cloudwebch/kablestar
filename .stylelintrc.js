module.exports = {
	extends: ['stylelint-config-wordpress/scss', 'stylelint-config-prettier'],
	plugins: ['stylelint-scss'],
	rules: {
		'block-no-empty': null,
		'no-descending-specificity': null,
		'declaration-property-unit-whitelist': null,
		'font-family-no-missing-generic-family-keyword': null,
		'function-url-quotes': 'always',
		// 'at-rule-semicolon-space-before': 'always-single-line'
	}
};

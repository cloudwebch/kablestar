/**
 * External dependencies
 */
// eslint-disable-next-line no-unused-vars
import $ from 'jquery';

(function(document, $, undefined) {
	var product = {};

	product.init = function() {
		// this.fancybox();
	};

	product.fancybox = () => {
		$('[data-fancybox="images"]').fancybox({
			buttons: ['close'],
			margin: [44, 0, 22, 0],
			thumbs: {
				autoStart: true,
				axis: 'x',
			},
		});
	};

	product.init();
})(document, jQuery);

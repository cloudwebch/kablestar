/**
 * External dependencies
 */
// eslint-disable-next-line no-unused-vars
import $ from 'jquery';

(function(document, $, undefined) {
	var product = {};

	product.init = function() {
		this.fancybox();
	};

	product.fancybox = () => {
		$('[data-fancybox="images"]').fancybox({
			// afterShow: function(instance, current) {
			// 	console.log('instance', instance);
			// 	console.log('instance', $(instance.Thumbs.$list[0]));
			// 	// $(instance.Thumbs.$list[0]).slick({
			// 	// 	infinite: true,
			// 	// 	slidesToShow: 7,
			// 	// 	slidesToScroll: 1,
			// 	// });
			// },
			baseTpl: `<div class="fancybox-container" role="dialog" tabindex="-1">
				<div class="fancybox-bg"></div>
				<div class="fancybox-inner">
				<div class="fancybox-caption"><div class="fancybox-caption__body"></div></div>
				<div class="fancybox-toolbar">{{buttons}}</div>
				<div class="fancybox-navigation">{{arrows}}</div>
				<div class="fancybox-stage"></div>
				</div></div>`,
			btnTpl: {
				close: `<button data-fancybox-close class="fancybox-button fancybox-button--close" title="{{CLOSE}}">
					<svg width="25" height="25" viewBox="0 0 16 16"><path d="M12.243 3.054l.707.707-9.193 9.192-.707-.707z"></path><path d="M12.946 12.243l-.707.707-9.192-9.193.707-.707z"></path></svg>
					</button>`,
				arrowLeft: `<button data-fancybox-prev class="fancybox-button fancybox-button--arrow_left" title="{{PREV}}">
				<div><svg width="30" height="30" viewBox="0 0 16 16"><path d="M10.475 14.158L4.818 8.501l.707-.707 5.657 5.657z"></path><path d="M11.181 3.548L5.524 9.205l-.707-.707 5.657-5.657z"></path></svg></div>
				</button>`,
				arrowRight: `<button data-fancybox-next class="fancybox-button fancybox-button--arrow_right" title="{{NEXT}}">
				<div><svg width="30" height="30" viewBox="0 0 16 16"><path d="M5.518 2.849l5.657 5.657-.707.707L4.81 3.556z"></path><path d="M4.812 13.445l5.657-5.657.707.707-5.657 5.657z"></path></svg></div>
				</button>`,
			},
			caption: function(instance, item) {
				return l18n_js_single_product.caption || '';
			},
			buttons: ['close'],
			// infobar: false,
			margin: [44, 0, 22, 0],
			thumbs: {
				autoStart: true,
				axis: 'x',
			},
		});
	};

	product.init();
})(document, jQuery);

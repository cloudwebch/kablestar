// import WooCommerceRestApi from '@woocommerce/woocommerce-rest-api';
// import axios from 'axios';
// axios.interceptors.request.use(function(config) {
// 	const { headers = {} } = config || {};
// 	if (headers['User-Agent']) delete config.headers['User-Agent'];
//
// 	return config;
// });

// import woo_api from '../helpers/woo_api';

(function(document, $, undefined) {
	var productArchive = {};

	productArchive.init = function() {
		this.setGridView();
		this.gridToListView();
		this.loadMore();
		// this.widgetMenuToggle();
	};

	productArchive.setGridView = function() {
		var productsGrid = $('[rel="product-view"]');
		if (!Cookies.get('gridcookie')) {
			return false;
		} else {
			switch (Cookies.get('gridcookie')) {
				case 'grid-view':
					productsGrid
						.removeClass('products-list-view')
						.addClass('products-grid-view');
					break;
				case 'list-view':
					productsGrid
						.removeClass('products-grid-view')
						.addClass('products-list-view');
					break;
				default:
					return false;
			}
		}
	};

	productArchive.gridToListView = function() {
		// var productGrid = $('[rel="product-view"]');
		// console.log(productGrid.prop("classList"))
		$('.view-mode').on('click', 'button', function() {
			var className = $(this).attr('class');
			// console.log('class', className);
			Cookies.remove('gridcookie');
			$('.view-mode button').removeClass('active');
			$(this).addClass('active');
			Cookies.set('gridcookie', className, { path: '/' });
			productArchive.checkSetGridStyle(
				$('[rel="product-view"]'),
				className
			);
		});
	};

	productArchive.checkSetGridStyle = function($theGrid, className) {
		$theGrid.fadeOut();
		if ($theGrid.is('.products-grid-view')) {
			$theGrid
				.removeClass('products-grid-view')
				.addClass('products-' + className);
		}
		if ($theGrid.is('.products-list-view')) {
			$theGrid
				.removeClass('products-list-view')
				.addClass('products-' + className);
		}
		$theGrid.fadeIn();
	};

	productArchive.loadMore = function() {
		let loading = false;
		const productContainter = $('[rel="product-view"]');
		// productContainter.append('<button class="loading"></button>');
		const loadingDiv = $('[rel="load-more"]');
		let page = 2;
		const scrollHandling = {
			allow: true,
			reallow: function() {
				scrollHandling.allow = true;
			},
			delay: 500, // (milliseconds) adjust to the highest acceptable value
		};

		$(window).scroll(function() {
			if (!loading && scrollHandling.allow) {
				scrollHandling.allow = false;
				setTimeout(scrollHandling.reallow, scrollHandling.delay);

				var offset = $(loadingDiv).offset().top - $(window).scrollTop();
				console.log('offset', offset);
				if (1600 > offset) {
					loading = true;

					var data = {
						action: 'infinite_scroll',
						page,
						category_id: l18n_js_archive.category_id,
						nonce: l18n_js_archive.nonce,
					};

					$.post(woocommerce_params.ajax_url, data, function(
						response
					) {
						if (response.success) {
							// console.log('data', response);
							$(response.data)
								.hide()
								.appendTo(productContainter)
								.fadeIn(1000);

							if (page >= l18n_js_archive.max_pages) {
								$(loadingDiv).remove();
								return false;
							}

							page = page + 1;
							loading = false;
						} else {
							// console.log(res);
						}
					}).fail(function(xhr, textStatus, e) {
						// console.log(xhr.responseText);
					});
				}
			}
		});
	};

	productArchive.init();
})(document, jQuery);

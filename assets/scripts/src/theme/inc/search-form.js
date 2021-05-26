import WooCommerceRestApi from '@woocommerce/woocommerce-rest-api';
import axios from 'axios';

axios.interceptors.request.use(function(config) {
	const { headers = {} } = config || {};
	if (headers['User-Agent']) delete config.headers['User-Agent'];

	return config;
});

/*
https://woocommerce.github.io/woocommerce-rest-api-docs/?javascript#create-a-product
https://woocommerce.github.io/woocommerce-rest-api-docs/?javascript#rest-api-keys
https://www.npmjs.com/package/@woocommerce/woocommerce-rest-api
https://woocommerce.github.io/woocommerce-rest-api-docs/#product-properties
https://sgwebpartners.com/how-to-use-woocommerce-api/
 */

const searchForm = ((document, window, $) => {
	const init = () => {
		// console.log(productIds());
		const WpJsonUrl = document.querySelector(
			'link[rel="https://api.w.org/"]'
		).href;
		// then take out the '/wp-json/' part
		const locationOrigins = WpJsonUrl.replace('/wp-json/', '');
		const productIds = () => {
			const ids = [];
			Array.from(document.querySelectorAll('.last-seen-product')).map(
				(item) => {
					ids.push(item.getAttribute('data-product-id'));
				}
			);
			return ids;
		};

		const products = productIds();

		// const productIds = productIds();
		//consumer key = ck_0b3cda3a2edc558df8fe82126ddcc9d56f501155
		//Consumer secret = cs_54795c58ea69c81406ea2006ff9fa4eaca8bc535

		const lastSeenProducts = function() {
			if (!!!products.length) {
				return false;
			}
			const boxWrap = document.querySelector(
				'[rel="last-seen-products"]'
			);

			const api = new WooCommerceRestApi({
				url: locationOrigins,
				consumerKey: 'ck_0b3cda3a2edc558df8fe82126ddcc9d56f501155',
				consumerSecret: 'cs_54795c58ea69c81406ea2006ff9fa4eaca8bc535',
				version: 'wc/v3',
			});

			products.forEach((productId) => {
				api.get(`products/${productId}`).then((response) => {
					const item = `<li>
																<a href="${response.data.permalink}" title="${response.data.name}">
																	<div class="item-left">
																		<img src="${response.data.images[0].src}" alt="${response.data.images[0].alt}">
																	</div>
																	<div class="item-right">
																		<span class="item-price">${response.data.price_html}</span>
																		<span class="item-name">${response.data.name}</span>
																	</div>
																</a>
															</li>`;

					boxWrap.insertAdjacentHTML('beforeend', item);
				});
			});
			setTimeout(function() {
				setBoxPosition();
			}, 500);
			handleSearchForm();
		};

		const setBoxPosition = () => {
			const siteHeaderHeight = $('.site-header .wrap').outerHeight(true);

			// var element = document.querySelector('.site-header .wrap');
			//
			// console.log('siteHeaderHeight 1', siteHeaderHeight);
			// console.log('siteHeaderHeight 2', siteHeaderHeight);
			$('.latest-seen-products').css({ top: siteHeaderHeight });
		};

		const handleSearchForm = () => {
			const theBody = $('body'),
				searchBoxField = $('.product-search-box input[type=search]');

			searchBoxField.focusin(function() {
				theBody.addClass('search-focus-in');
				theBody.append('<div class="body-overlay"></div>');
			});
			searchBoxField.focusout(function() {
				// console.log('focus in');
				theBody.removeClass('search-focus-in');
				$('.body-overlay')
					.fadeOut()
					.remove();
			});
		};

		lastSeenProducts();
	};

	return {
		init,
	};
})(document, window, jQuery);

export default searchForm;

import WooCommerceRestApi from '@woocommerce/woocommerce-rest-api';
import axios from 'axios';
axios.interceptors.request.use(function(config) {
	const { headers = {} } = config || {};
	if (headers['User-Agent']) delete config.headers['User-Agent'];

	return config;
});
const WpJsonUrl = window.document.querySelector(
	'link[rel="https://api.w.org/"]'
).href;
// then take out the '/wp-json/' part
const locationOrigins = WpJsonUrl.replace('/wp-json/', '');

const woo_api = new WooCommerceRestApi({
	url: locationOrigins,
	consumerKey: 'ck_0b3cda3a2edc558df8fe82126ddcc9d56f501155',
	consumerSecret: 'cs_54795c58ea69c81406ea2006ff9fa4eaca8bc535',
	version: 'wc/v3',
});

export default woo_api;

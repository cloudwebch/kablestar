const lastSeenProducts = ((document, window, $) => {
	const init = () => {
		// console.log(productIds());

		// const products = productIds();
		if (!Cookies.get('bb_last_seen_products')) {
			return false;
		}
		const products = JSON.parse(Cookies.get('bb_last_seen_products')).length
			? Cookies.get('bb_last_seen_products')
			: '';
		// console.log("Cookies.get('bb_last_seen_products')", products);
		$.ajax({
			type: 'GET',
			// eslint-disable-next-line no-undef
			url: woocommerce_params.ajax_url,
			data: {
				// eslint-disable-next-line no-undef
				action: 'get_latest_seen_products',
				// eslint-disable-next-line no-undef
				nonce: l18n_js_theme.nonce,
				products,
			},
			success(response) {
				// console.log('DATA', response.data);
				if (response.success === true && response.data) {
					$('[rel="last-seen-slider"]')
						.append(response.data)
						.slick({
							slidesToShow: 6,
							slidesToScroll: 1,
							infinite: false,
							//					        dots: false,
							responsive: [
								{
									breakpoint: 1024,
									settings: {
										slidesToShow: 3,
									},
								},
								{
									breakpoint: 400,
									settings: {
										slidesToShow: 1,
									},
								},
							],
						});
					$('[rel="last-seen"]').fadeIn();
				}
			},
			error(error) {
				console.log('ERROR------>', error);
			},
		});
	};

	return {
		init,
	};
})(document, window, jQuery);

export default lastSeenProducts;

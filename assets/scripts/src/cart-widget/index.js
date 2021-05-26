/**
 * External dependencies
 */
// eslint-disable-next-line no-unused-vars
import $ from 'jquery';

(function(document, $, undefined) {
	function supports_html5_storage() {
		try {
			return 'localStorage' in window && window['localStorage'] !== null;
		} catch (e) {
			return false;
		}
	}
	function updateQty(key, qty) {
		const url = woocommerce_params.ajax_url,
			data = {
				action: 'update_item_from_cart',
				cart_item_key: key,
				qty: parseFloat(qty),
			};

		$.post(url, data).done(function(data) {
			updateCartFragment();
		});
	}
	function updateCartFragment() {
		const $refreshFragment = {
			url: woocommerce_params.ajax_url,
			type: 'POST',
			data: { action: 'woocommerce_get_refreshed_fragments' },
			success: function(data) {
				if (data && data.fragments) {
					$.each(data.fragments, function(key, value) {
						$(key).replaceWith(value);
					});

					if (supports_html5_storage()) {
						sessionStorage.setItem(
							'wc_fragments',
							JSON.stringify(data.fragments)
						);
						sessionStorage.setItem('wc_cart_hash', data.cart_hash);
					}
					$('body').trigger('wc_fragments_refreshed');
				}
			},
		};
		//Always perform fragment refresh
		$.ajax($refreshFragment);
	}

	$('body').on('change', '.qty, input[type=number]', function() {
		const qty = $(this).val(),
			currentVal = parseFloat(qty),
			cart_item_key = $(this)
				.parent()
				.parent()
				.data('cart_item_key');
		// console.log('changed');
		updateQty(cart_item_key, currentVal);
	});

	$('.widget_shopping_cart').on('click', '.mini-cart-button', function(
		event
	) {
		// Get current quantity values
		// console.log($(this).parent());
		const $thisParent = $(this).parent(),
			qty = $thisParent.find('.qty'),
			// cart_item_key = $thisParent.data('cart_item_key'),
			val = parseFloat(qty.val()),
			max = parseFloat(qty.attr('max')),
			min = parseFloat(qty.attr('min')),
			step = parseFloat(qty.attr('step'));

		// Change the value if plus or minus

		if ($(this).is('.mini-cart-button-plus')) {
			if (max && max <= val) {
				qty.val(max);
			} else {
				qty.val(val + step);
			}
		} else {
			if (min && min >= val) {
				qty.val(min);
			} else if (val > 1) {
				qty.val(val - step);
			}
		}

		if (parseFloat(qty.val()) === 1) {
			$('.mini-cart-button-minus').prop('disabled', true);
		} else {
			$('.mini-cart-button-minus').prop('disabled', false);
		}

		qty.trigger('change');

		// if (val !== parseFloat(qty.val())) {
		// 	updateQty(cart_item_key, parseFloat(qty.val()));
		// }
	});
})(document, jQuery);

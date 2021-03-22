jQuery(document).on(
	'click',
	'.kabelstar-woocommerce-notice .notice-dismiss',
	function() {
		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: 'dismiss_woocommerce_notice',
			},
		});
	}
);

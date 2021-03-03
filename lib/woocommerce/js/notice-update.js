jQuery(document).on( 'click', '.genesis-webpack-replace-woocommerce-notice .notice-dismiss', function() {

	jQuery.ajax({
	    url: ajaxurl,
	    data: {
	        action: 'genesis_webpack_replace_dismiss_woocommerce_notice'
	    }
	});

});

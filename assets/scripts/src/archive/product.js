(function(document, $, undefined) {
	var productArchive = {};

	productArchive.init = function() {
		this.setGridView();
		this.gridToListView();
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

	// productArchive.widgetMenuToggle = function() {
	// 	$('.sidebar .widget ul.sub-menu')
	// 		.parent()
	// 		.addClass('parent-item');
	// 	var parentItem = $('.sidebar .widget ul > li.parent-item');
	// 	$('.sidebar .widget ul > li.parent-item > ul').hide();
	//
	// 	if (
	// 		parentItem.hasClass('current-menu-item') ||
	// 		parentItem.hasClass('current-product_cat-ancestor')
	// 	) {
	// 		$(
	// 			'.sidebar .widget ul > li.parent-item.current-menu-item > ul'
	// 		).show();
	// 	}

	// $('.sidebar .widget ul > li.parent-item').click(function() {
	// 	var li = $(this).closest('li');
	// 	li.find(' > ul').slideToggle('fast');
	// 	li.find('i').toggleClass('icon-minus-squared');
	// 	// $(this).toggleClass('open-item');
	// });

	// $('.sidebar .widget ul.children li, ul.children li > a').click(function(
	// 	e
	// ) {
	// 	e.stopPropagation();
	// });
	// };

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

	productArchive.init();
})(document, jQuery);

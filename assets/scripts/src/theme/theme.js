/**
 * External dependencies
 */
// eslint-disable-next-line no-unused-vars
import $ from 'jquery';

/**
 * Internal dependencies
 */
import _debounce from '../helpers/debounce';
import './inc/responsive-menus';
import searchForm from './inc/search-form';
import headerScroll from './inc/header-scroll';
import lastSeenProducts from './inc/latest-seen-products';

// $(window).on('load', searchForm.init);
// $(window).on('load', headerScroll.init);

$(document).ready(function() {
	searchForm.init();
	searchForm.handleSearchForm();
	headerScroll.init();
	lastSeenProducts.init();
});

// console.log('window', window);
window.addEventListener(
	'resize',
	_debounce(() => headerScroll.init(), 200, false),
	false
);

window.addEventListener(
	'resize',
	_debounce(() => searchForm.handleSearchForm(), 200, false),
	false
);

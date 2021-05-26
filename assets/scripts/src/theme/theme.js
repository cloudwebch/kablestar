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

// $(window).on('load', searchForm.init);
// $(window).on('load', headerScroll.init);

$(document).ready(function() {
	searchForm.init();
	headerScroll.init();
});

// console.log('window', window);
window.addEventListener(
	'resize',
	_debounce(() => headerScroll.init(), 200, false),
	false
);

window.addEventListener(
	'resize',
	_debounce(() => searchForm.init(), 200, false),
	false
);

/**
 * External dependencies
 */
// eslint-disable-next-line no-unused-vars
import $ from 'jquery';

/**
 * Internal dependencies
 */
import './inc/responsive-menus';
import searchForm from './inc/search-form';

$(window).on('load', searchForm.init);

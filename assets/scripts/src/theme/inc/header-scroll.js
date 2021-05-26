const headerScroll = ((document, window, $) => {
	const init = () => {
		// console.log('_isVisible()', _isVisible());
		if ('none' === _isVisible()) {
			window.removeEventListener('scroll', headerStickOnScroll);
			return false;
		}

		window.addEventListener('scroll', headerStickOnScroll);
	};

	const headerStickOnScroll = () => {
		const siteHeader = document.querySelector('.site-header');
		const siteInner = document.querySelector('.site-inner');
		const titleArea = document.querySelector('.title-area');
		// const lastSeen = document.querySelector('.latest-seen-products');
		//
		// const lastSeenInitialPosition = lastSeen.style.top;
		let scrollRun = false;
		if (window.pageYOffset >= siteHeader.offsetHeight) {
			siteHeader.classList.add('header-fixed');
			siteHeader.style.top = `${-titleArea.offsetHeight + 5}px`;
			siteInner.style.marginTop = `${siteHeader.offsetHeight}px`;

			// console.log(
			// 	'lastSeenInitialPosition',
			// 	parseInt(lastSeenInitialPosition)
			// );
			// if (scrollRun === false) {
			// 	lastSeen.style.top = `${parseInt(lastSeenInitialPosition) -
			// 		titleArea.offsetHeight +
			// 		5}px`;
			// }
		} else {
			siteHeader.classList.remove('header-fixed');
			siteHeader.style.top = 'initial';
			// lastSeen.style.top = lastSeenInitialPosition;
			siteInner.removeAttribute('style');
		}
		// scrollRun = true;
	};

	const _isVisible = () => {
		//genesis-mobile-nav-primary

		const element = document.getElementById('genesis-mobile-nav-primary'),
			style = window.getComputedStyle(element);
		return style.getPropertyValue('display');
	};

	return {
		init,
	};
})(document, window, jQuery);

export default headerScroll;

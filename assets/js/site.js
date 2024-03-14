
import Sliders from './_site/sliders';
import LazyLoader from './_site/lazy-load';
import Navigation from './_site/navigation';
import StickyHeader from './_site/sticky-header';
import Search from './_site/search';

document.addEventListener('DOMContentLoaded', () => {
	Sliders.init();
	LazyLoader.init();
	Navigation.init();
	StickyHeader.init();
	Search.init();
});

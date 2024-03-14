
import Sliders from './_site/sliders';
import LazyLoader from './_site/lazy-load';
import Navigation from './_site/navigation';
import StickyHeader from './_site/sticky-header';


document.addEventListener('DOMContentLoaded', () => {
	Sliders.init();
	LazyLoader.init();
	Navigation.init();
	StickyHeader.init();
});

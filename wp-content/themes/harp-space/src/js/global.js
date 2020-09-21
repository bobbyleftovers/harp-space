
import scrollTo from './lib/scroll-to'
function scrollNav () {
	const links = document.querySelectorAll('.menu-item a')

	links.forEach(link => {
		const href = link.getAttribute('href')
		if(href[0] === '#' && document.querySelector(href)) {
			link.addEventListener('click', e => {
				e.preventDefault()
				scrollTo(document.querySelector(href))
			})
		}
	})
}
export {
	scrollNav
}
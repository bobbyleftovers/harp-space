
import scrollTo from './lib/scroll-to'
function scrollNav () {
	const navLinks = document.querySelectorAll('.menu-item a')

	navLinks.forEach(link => {
		const href = link.getAttribute('href')
		if(href[0] === '#' && document.querySelector(href)) {
			link.addEventListener('click', e => {
				e.preventDefault()
				scrollTo(document.querySelector(href))
			})
		}
	})

	const links = document.querySelectorAll('a.scroll-link')

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
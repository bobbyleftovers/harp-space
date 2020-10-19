import scrollTo from '../../src/js/lib/scroll-to'

export default function (el) {
	el.querySelector('.back-to-top').addEventListener('click', e => {
		e.preventDefault()
		scrollTo()
	})
}

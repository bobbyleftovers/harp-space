import scrollTo from '../../src/js/lib/scroll-to'

export default function (el) {
	const topBtn = el.querySelector('.back-to-top')
	console.log(el.offsetTop)
	topBtn.addEventListener('click', e => {
		e.preventDefault()
		scrollTo()
	})

	window.addEventListener('scroll', evt => {
		if (window.scrollY > 900) {
			topBtn.classList.add('active')
			if(window.scrollY <= (el.offsetTop - el.offsetHeight)) {
				topBtn.classList.remove('rel')
			}
		} else if (window.scrollY < 900) {
			topBtn.classList.remove('active')
		}

		if (window.scrollY >= (el.offsetTop - el.offsetHeight)) {
			topBtn.classList.add('rel')
		}
	})

}

export default function (el) {
	const header = document.querySelector('header.header')

	window.addEventListener('resize', () => {
		setPadding()
	})

	setPadding()

	function setPadding () {
		el.style.paddingTop = header.offsetHeight + 'px'
	}
}
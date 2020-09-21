export default function (el) {
	console.log('hero', el)
	const header = document.querySelector('header.header')

	window.addEventListener('resize', () => {
		setPadding()
	})

	setPadding()

	function setPadding () {
		console.log(header.offsetHeight)
		el.style.paddingTop = header.offsetHeight + 'px'
	}
}
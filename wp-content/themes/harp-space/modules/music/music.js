// import { on, select, selectAll, toggleClass, addClass, removeClass, hasClass, onFocus, onEscape, getData, setAttribute, getAttribute } from '../../src/js/lib/dom'
// import { map } from '../../src/js/lib/utils'

class Music {
	constructor (el) {
		this.el = el
		this.previews = el.querySelectorAll('.preview')
		this.init()
	}

	init () {
		const self = this

		this.previews.forEach(preview => {
			let track = preview.querySelector('audio')
			let play = preview.querySelector('.preview__play')
			let pause = preview.querySelector('.preview__pause')
			let timer = preview.querySelector('.preview__timer')

			timer.innerHTML = this.getFormattedTime(track.currentTime)
			
			track.ontimeupdate = function (e) {
				timer.innerHTML = self.getFormattedTime(track.currentTime)
			}

			play.addEventListener('click', (e) => {
				this.deactivateAll()
				preview.classList.add('is-playing')
				track.play()
			})
			
			pause.addEventListener('click', () => {
				preview.classList.remove('is-playing')
				track.pause()
			})
		})
	}

	getFormattedTime (ts) {
		let sec = Math.floor( ts )
		let min = Math.floor( sec / 60 )
		min = min >= 10 ? min : '0' + min
		sec = Math.floor( sec % 60 )
		sec = sec >= 10 ? sec : '0' + sec
		return min + ':' + sec
	}

	deactivateAll () {
		this.previews.forEach(preview => {
			preview.classList.remove('is-playing')
			preview.querySelector('audio').pause()
			preview.querySelector('audio').currentTime = 0
			preview.querySelector('.preview__timer').innerHTML = this.getFormattedTime(0)
		})
	}

	toggleTracklist () {
		console.log('toggle tracks')
	}
}


export default function (el) {
	new Music(el)
}

// import { on, select, selectAll, toggleClass, addClass, removeClass, hasClass, onFocus, onEscape, getData, setAttribute, getAttribute } from '../../src/js/lib/dom'
// import { map } from '../../src/js/lib/utils'
import {collapseSection, expandSection} from '../../src/js/lib/utils'

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

		this.el.querySelector('.btn-toggle-list').addEventListener('click', function(e) {
			const section = document.querySelector('.list__wrap');
			const isCollapsed = section.getAttribute('data-collapsed') === 'true';
			e.target.classList.toggle('open')
				
			if(isCollapsed) {
				expandSection(section)
				section.setAttribute('data-collapsed', 'false')
			} else {
				collapseSection(section)
			}
		});

		window.addEventListener('resize', () => {
			const section = document.querySelector('.list__wrap');
			section.setAttribute('data-collapsed', 'true')
			this.el.querySelector('.btn-toggle-list').classList.remove('open')
			collapseSection(section)
		})
	}

	getFormattedTime (ts) {
		let sec = Math.floor( ts )
		let min = Math.floor( sec / 60 )
		min = min >= 10 ? min : min
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
}


export default function (el) {
	new Music(el)
}

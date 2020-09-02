import { on, select, addClass, removeClass, trigger } from '../../src/js/lib/dom'
export default el => {
  const volumeToggle = select('.js-video-volume-toggle', el)
  const video = select('.js-video', el)
  const vimeo = /player.vimeo.com/.test(video.getAttribute('src'))
  let player = false
  let volume = 0

  // Because getting Babel errors from vimeo player package
  if (vimeo) {
    const script = document.createElement('script')
    script.setAttribute('src', '//player.vimeo.com/api/player.js')
    document.body.appendChild(script)
  }

  const initVimeoPlayer = () => {
    player = window.Vimeo !== 'undefined' ? new window.Vimeo.Player(video) : false
  }

  const checkVimeoPlayer = () => {
    !player && initVimeoPlayer()
  }

  const updatePlayerVolume = () => {
    if (volume > 0) {
      addClass('is-volume-on', el)
    } else {
      removeClass('is-volume-on', el)
    }
  }

  on('click', (e) => {
    // Mute for vimeo embeds
    if (vimeo) {
      checkVimeoPlayer()
      if (player) {
        if (volume > 0) {
          volume = 0
        } else {
          volume = 1
        }
        player.setVolume(volume)
        updatePlayerVolume()
      } else {
        // Player wasn't initalized yet, try again in a split sec
        setTimeout(() => {
          trigger('click', volumeToggle)
        }, 250)
      }
    }
  }, volumeToggle)
}

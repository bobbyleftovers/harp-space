import { select, trigger, addClass, removeClass, getAttribute, onEnter, on } from 'lib/dom'

const MODAL_ACTIVE_CLASS = 'video-modal--activate'
const VIDEO_ACTIVE_CLASS = 'video--activate'

window.onYouTubeIframeAPIReady = () => {
  trigger('yt-loaded', window)
}

export default (el) => {
  const modalToggle = el
  const modalID = getAttribute('href', el)
  const modal = select(modalID)
  const closeButton = select('.js-close', modal)
  const iframeWrapper = select('.js-video-iframe-wrapper', modal)
  const iframe = select('iframe', iframeWrapper)
  let vimeoPlayer = null
  const activateVideo = () => addClass(VIDEO_ACTIVE_CLASS, iframeWrapper)
  const activateModalVideo = () => {
    setTimeout(() => closeButton.focus(), 250)
    addClass(MODAL_ACTIVE_CLASS, modal)
  }
  const deactivateModalVideo = () => removeClass(MODAL_ACTIVE_CLASS, modal)
  const onPlayerReady = (event) => {
    if (modalToggle) {
      on('click', (e) => {
        e.preventDefault()
        vimeoPlayer ? vimeoPlayer.play() : event.target.playVideo()
        activateVideo()
        activateModalVideo()
      }, modalToggle)
      onEnter(modalToggle, (e) => {
        e.preventDefault()
        vimeoPlayer ? vimeoPlayer.play() : event.target.playVideo()
        activateVideo()
        activateModalVideo()
      })
      on('click', () => {
        vimeoPlayer ? vimeoPlayer.pause() : event.target.stopVideo()
        deactivateModalVideo()
      }, el)
      on('click', () => {
        vimeoPlayer ? vimeoPlayer.pause() : event.target.stopVideo()
        deactivateModalVideo()
      }, closeButton)
      onEnter(closeButton, (e) => {
        vimeoPlayer ? vimeoPlayer.pause() : event.target.stopVideo()
        deactivateModalVideo()
      })
    }
  }

  on('yt-loaded', () => {
    const player = new window.YT.Player(iframeWrapper, {
      events: {
        'onReady': onPlayerReady
      }
    })
    return player
  }, window)

  const checkForVimeo = setInterval(() => {
    if (typeof window.Vimeo !== 'undefined') {
      clearInterval(checkForVimeo)
      vimeoPlayer = new window.Vimeo.Player(iframe)
      vimeoPlayer.on('loaded', () => {
        onPlayerReady()
      })
    }
  }, 1000)
}

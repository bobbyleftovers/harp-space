import init from './lib/init-modules'
import { addClass, hasClass } from './lib/dom'

document.addEventListener('DOMContentLoaded', () => {
  // Init modules
  init({
    module: 'modules'
  }).mount()

  // Add touch class if touch device and re-init modules
  window.addEventListener('touchstart', () => {
    if (!hasClass('is-touch', document.body)) {
      addClass('is-touch', document.body)
      init({
        module: 'modules'
      }).mount()
    }
  })
})

import { on, select, selectAll, toggleClass, addClass, removeClass, hasClass, onFocus, onEscape, getData, setAttribute, getAttribute } from '../../src/js/lib/dom'
import { map } from '../../src/js/lib/utils'
console.log('header js')
export default function (el) {
  // const slideoutToggle = selectAll('.js-slideout-toggle')
  // if (slideoutToggle) {
  //   map((item) => {
  //     on('click', () => {
  //       toggleClass('slideout-activate', document.body)
  //       removeClass('search-activate', document.body)
  //       const classRemove = getData('remove-class', slideoutToggle)
  //       const classRemoveTarget = getData('remove-class-target', slideoutToggle) || document.body
  //       if (classRemove) {
  //         removeClass(classRemove, select(classRemoveTarget, el))
  //       }
  //       if (getAttribute('aria-expanded', slideoutToggle) === 'false') {
  //         setAttribute('aria-expanded', true, slideoutToggle)
  //       } else {
  //         setAttribute('aria-expanded', false, slideoutToggle)
  //       }
  //     }, item)
  //   }, slideoutToggle)
  // }

  // const searchToggle = selectAll('.js-search-toggle')
  // if (searchToggle) {
  //   map((item) => {
  //     on('click', () => {
  //       toggleClass('search-activate', document.body)
  //       removeClass('slideout-activate', document.body)
  //       if (getAttribute('aria-expanded', searchToggle) === 'false') {
  //         setAttribute('aria-expanded', true, searchToggle)
  //       } else {
  //         setAttribute('aria-expanded', false, searchToggle)
  //       }
  //     }, item)
  //   }, searchToggle)
  // }

  function checkScroll (e) {
    const slideInDuration = 1000

    // Check if scrolled past height of nav
    if (window.scrollY > (el.offsetTop + el.offsetHeight)) {
      if (!hasClass('is-scrolled-past', el)) {
        addClass('is-scrolled-past', el)
        addClass('is-sliding-in', el)
        addClass('header-scrolled-past', document.body)

        setTimeout(() => {
          removeClass('is-sliding-in', el)
        }, slideInDuration)
      }
    } else if (hasClass('is-scrolled-past', el)) {
      removeClass('is-scrolled-past', el)
      removeClass('is-sliding-in', el)
      removeClass('header-scrolled-past', document.body)
    }
  }

  function deactivateCurrentMenuItem () {
    const currentActive = select('#menu-main-navigation>.menu-item.is-active', el)
    currentActive && removeClass('is-active', currentActive)
  }

  // Add sub menu toggle on focus
  const subMenuItems = selectAll('#menu-main-navigation>.menu-item>a', el)
  map((item) => {
    onFocus(item, item => {
      deactivateCurrentMenuItem()
      const subMenu = select('.sub-menu', item.parentNode)
      setAttribute('aria-hidden', false, subMenu)
      addClass('is-active', item.parentNode)
    })
  }, subMenuItems)

  const searchButton = select('.header__search__toggle')
  onFocus(searchButton, searchButton => {
    deactivateCurrentMenuItem()
  })

  // Disable click for menu items with children
  const touchBody = select('.is-touch')
  if (touchBody) {
    const subMenuTouchItems = selectAll('#menu-main-navigation>.menu-item-has-children>a', touchBody)
    map((item) => {
      on('click', e => {
        e.preventDefault()
        e.stopPropagation()
        addClass('is-active', item.parentNode)
      }, item)
    }, subMenuTouchItems)
  }

  on('click', e => {
    deactivateCurrentMenuItem()
  }, document.body)

  onEscape(document.body, () => {
    deactivateCurrentMenuItem()
  })

  window.addEventListener('scroll', checkScroll)
}

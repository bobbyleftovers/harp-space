import { on, select, selectAll, addClass, removeClass, hasClass, getModuleOptions, setStyle, setAttribute, closest } from 'lib/dom'
import { map, partial, pipe } from 'lib/utils'

const MODULE_NAME = 'slideout'
console.log('slideout')
export default function (el) {
  const defaults = {
    item: '.menu-item-has-children',
    content: '.sub-menu',
    toggle: '.menu-item-has-children > a',
    activeClass: 'submenu-activate',
    noAccordionClass: 'submenu-no-accordion'
  }
  const args = getModuleOptions(MODULE_NAME, el, defaults)
  const rows = selectAll(args.item, el)
  const activateRow = addClass(args.activeClass)
  const deactivateRow = removeClass(args.activeClass)

  const showContent = (row) => {
    const content = select(args.content, row)
    const contentWrap = closest(args.content, row)
    if (contentWrap) {
      setStyle('maxHeight', '100%', contentWrap)
    }
    if (content) {
      setStyle('maxHeight', content.scrollHeight + 'px', content)
      setAttribute('aria-hidden', false, content)
    }
    return row
  }
  const isActiveRow = (row) => hasClass(args.activeClass, row)
  const isSubRow = (row) => closest(args.content, row)
  const hideContent = (row) => {
    const content = select(args.content, row)
    if (content) {
      setStyle('maxHeight', '0', content)
      setAttribute('aria-hidden', true, content)
    }
    return row
  }
  const deactivateRows = () => map((row) => {
    hideContent(row)
    deactivateRow(row)
  }, rows)

  const deactivateRowsSameLevel = (row) => {
    const rowsSameLevel = selectAll(args.item, row.parentNode)
    map((row) => {
      hideContent(row)
      deactivateRow(row)
    }, rowsSameLevel)
  }

  const maybeActiveRow = (row) => {
    if (isActiveRow(row)) {
      pipe(
        deactivateRow,
        hideContent
      )(row)
    } else {
      if (isSubRow(row)) {
        deactivateRowsSameLevel(row)
      } else {
        deactivateRows()
      }
      pipe(
        activateRow,
        showContent
      )(row)
    }
    return row
  }
  map((row) => {
    const rowHeader = select(args.toggle, row)
    if (rowHeader) {
      on('click', (e) => {
        e.preventDefault()
        partial(
          maybeActiveRow
        )(row)
      }, rowHeader)
    }
  }, rows)
}

<div class="slideout-overlay js-slideout-toggle"></div>
<header class="header" data-module="header">

  <div class="header__inner">
    <div class="header__logo">
      <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php
        // the_module('svg', array(
        //   'icon' => 'logo',
        //   'class' => 'logo header__logo__svg'
        // )); ?>
      </a>
    </div><?php

    if( has_nav_menu('header-primary') ) {
      // wp_nav_menu(array(
      //   'theme_location' => 'header-primary',
      //   'container' => 'nav',
      //   'container_class' => 'header__nav',
      //   'menu_class' => 'header__menu',
      //   'menu_id' => 'menu-main-navigation',
      //   'walker' => new Sub_Nav_Features('desktop')
      // ));
    } ?>

    <div class="header__icons">
      <button class="header__mobile__toggle js-slideout-toggle" data-remove-class="is-active" data-remove-class-target=".search-form--header" aria-label="Toggle navigation menu" aria-haspopup="true" aria-expanded="false">
        <span class="header__mobile__toggle__bar"></span>
        <span class="header__mobile__toggle__bar"></span>
        <span class="header__mobile__toggle__bar"></span>
        <span class="screen-reader-text">Toggle navigation menu</span>
      </button>
    </div>
  </div>
</header>

<div class="slideout-overlay js-slideout-toggle"></div>
<header class="header" data-module="header">

  <div class="header__inner">
    <div class="header__logo">
      <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php
        the_module('image', array(
          'image' => carbon_get_theme_option( 'logo' ),
          'class' => 'logo header__logo'
        )); ?>
      </a>
    </div>

    <div class="header__right">
      <div class="header__shares"><?php
        $links = carbon_get_theme_option( 'shares_links' );
        // print_r($links);
        foreach ($links as $link) {
          $icon = '<i class="fab fa-'.$link['social_links'][0].'"></i>';
          echo '<a href="'.$link['social_url'].'" class="share__link">'.$icon.'</a>';
        }?>
      </div><?php

      if( has_nav_menu('header-primary') ) {
        wp_nav_menu(array(
          'theme_location' => 'header-primary',
          'container' => 'nav',
          'container_class' => 'header__nav',
          'menu_class' => 'header__menu',
          'menu_id' => 'menu-main-navigation',
          'walker' => new Sub_Nav_Features('desktop')
        ));
      } ?>
    </div>

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

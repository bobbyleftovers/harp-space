<?php 
if( has_nav_menu('header-primary') ) { ?>
  <div class="slideout" data-module="slideout">
    <div class="slideout__inner">
      <div class="slideout__content">
        <div class="container">
          <div class="header__shares header__shares--mobile"><?php
            $links = carbon_get_theme_option( 'shares_links' );
            foreach ($links as $link) {
              $icon = '<i class="share__icon fab fa-'.$link['social_links'][0].'"></i>';
              echo '<a href="'.$link['social_url'].'" class="share__link">'.$icon.'</a>';
            }?>
            </div><?php

            wp_nav_menu(array(
              'theme_location' => 'header-primary',
              'container' => 'div',
              'container_class' => 'slideout__nav',
              'menu_class' => 'slideout__menu',
              'menu_id' => 'menu-main-navigation-mobile',
              'add_arrows' => true,
              'walker' => new Walker_Nav_Menu()
            ));?>
        </div>
      </div>
    </div>
  </div><?php
} ?>

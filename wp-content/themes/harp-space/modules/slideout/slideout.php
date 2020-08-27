<?php 
if( has_nav_menu('header-primary') ) { ?>
  <div class="slideout" data-module="slideout">
    <div class="slideout__inner">
      <div class="slideout__content"><?php
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
  </div><?php
} ?>

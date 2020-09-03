<footer class="footer">
  <div class="footer__inner">
    <div class="footer__logo">
      <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php
        the_module('image', array(
          'image' => carbon_get_theme_option( 'logo' ),
          'class' => 'logo footer__logo'
        )); ?>
        <span class="footer__copyright"><?= carbon_get_theme_option('copyright') ?></span>
      </a>
    </div>
    <div class="footer__block">
      <div class="footer__block footer__block__meta small">
        <div class="footer__signup">
          <?= do_shortcode(carbon_get_theme_option('signup_shortcode')) ?>
        </div>
        <span class="footer__privacy-msg">
          <?= carbon_get_theme_option('privacy_message') ?>
        </span>
        <div class="footer__credits"><?php
          $credits = carbon_get_theme_option( 'site_credits' );
          foreach ($credits as $credit) {
            echo '<span class="footer__credit">'.$credit['site_credit'].'</span>';
          }?>
        </div>
      </div>
    </div>
    <div class="footer__right">
      <div class="footer__shares"><?php
        $links = carbon_get_theme_option( 'shares_links' );
        foreach ($links as $link) {
          $icon = '<i class="fab fa-'.$link['social_links'][0].'"></i>';
          echo '<a href="'.$link['social_url'].'" class="share__link">'.$icon.'</a>';
        }?>
      </div><?php

      if( has_nav_menu('header-primary') ) {
        wp_nav_menu(array(
          'theme_location' => 'header-primary',
          'container' => 'nav',
          'container_class' => 'footer__nav',
          'menu_class' => 'footer__menu',
          'menu_id' => 'menu-main-navigation',
          'walker' => new Sub_Nav_Features('desktop')
        ));
      } ?>
    </div>
  </div>
</footer>

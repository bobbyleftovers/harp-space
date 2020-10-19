<?php
$credits = carbon_get_theme_option( 'site_credits' );
$bk_image = wp_get_attachment_image_src( carbon_get_theme_option( 'background_image' ), 'full' )[0];?>

<footer class="footer" data-module="footer" style="background-image: url('<?= $bk_image ?>')">
  <div class="footer__page-tools container">
    <a class="button button--clear button--small back-to-top">
      <i class="fas fa-arrow-up"></i>
      <span>Top</span>
    </a>
  </div>
  <div class="footer__inner container">
    <div class="footer__logo"><?php
        the_module('image', array(
          'image' => carbon_get_theme_option( 'logo' ),
          'class' => 'logo footer__logo'
        )); ?>
        <span class="footer__copyright"><?= carbon_get_theme_option('copyright') ?></span>
    </div>
    <div class="footer__center">
      <div class="footer__signup">
        <span class="signup__desc">Subscribe to our newsletter</span>
        <?= do_shortcode(carbon_get_theme_option('signup_shortcode')) ?>
      </div>
      <span class="footer__privacy-msg">
        <?= carbon_get_theme_option('privacy_message') ?>
      </span>
      <div class="footer__credits"><?php
        foreach ($credits as $credit) {
          echo '<span class="footer__credit">'.$credit['site_credit'].'</span>';
        }?>
      </div>
    </div>
    <div class="footer__right"><?php

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

      <div class="footer__shares"><?php
        $links = carbon_get_theme_option( 'shares_links' );
        foreach ($links as $link) {
          $icon = '<i class="fab fa-'.$link['social_links'][0].'"></i>';
          echo '<a href="'.$link['social_url'].'" class="share__link">'.$icon.'</a>';
        }?>
      </div>
    </div>
  </div>
</footer>

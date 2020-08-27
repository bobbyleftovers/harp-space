<footer class="footer">
  <div class="footer__inner">
    <div class="footer__block">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'footer',
          'container' => '',
          'menu_class' => 'footer__menu'
        ));
      ?>
    </div>
    <div class="footer__block footer__block__meta small">
      <p class="footer__copyright"><?= get_field( 'footer_copyright', 'option' ); ?></p>
      <?php
        // wp_nav_menu(array(
        //   'theme_location' => 'footer-meta',
        //   'container' => '',
        //   'menu_class' => 'footer__meta'
        // ));
      ?>
    </div>
  </div>
</footer>

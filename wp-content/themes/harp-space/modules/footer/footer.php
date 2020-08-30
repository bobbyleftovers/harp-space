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
      <p class="footer__copyright"></p>
    </div>
  </div>
</footer>

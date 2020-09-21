<?php if( have_rows('social_media_links', 'options') ): ?>
  <ul class="social-links container-xl container"><?php
    while( have_rows('social_media_links', 'options') ): the_row();
      $link = get_sub_field('link');?>
      <li class="social-links-item">
        <a class="social-links-link diamond" href="<?= $link['url']; ?>" target="_blank" title="<?= $link['label'] ?>">
          <span class="screen-reader-text"><?= $link['label'] ?></span><?php
          $type = get_sub_field('social_link_type');
          the_module('svg', array(
            'icon' => "icon-$type",
            'class' => "icon-$type social-links-icon"
          )); ?>
        </a>
      </li><?php
    endwhile; ?>
  </ul>
<?php endif; ?>

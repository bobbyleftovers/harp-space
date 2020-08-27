<?php
  $categories = get_the_terms( get_the_ID(), 'category' );
  // print_r(get_the_terms( get_the_ID(), 'category' ));
?>
<li class="post-card <?= $class ?>">
  <a class="post-card__link" href="<?= get_the_permalink( get_the_ID() ); ?>" title="<?= esc_attr( get_the_title() ); ?>">
    <?php the_module('image', array(
        'image' => get_post_thumbnail_id(),
        'class' => 'post-card__image',
        'cover' => true
    )); ?>
  </a><?php

  $cat_label = null;
  $cats_arr = [];
  if(!empty($categories) && !is_wp_error($categories)) {
    foreach($categories as $category) {
      $cats_arr[] = $category->name;
    }
    $cat_label = '<p class="post-card__category label">'.implode($cats_arr, ', ').'</p>';
  }
  echo $cat_label; ?>
  <a class="post-card__link" href="<?= get_the_permalink( get_the_ID() ); ?>" title="<?= esc_attr( get_the_title() ); ?>">
    <h2 class="post-card__title label"><?= get_the_title(); ?></h2>
  </a>
</li>

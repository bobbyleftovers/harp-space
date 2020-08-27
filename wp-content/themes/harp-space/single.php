<?php get_header(); ?>
<main id="main_content" class="" itemprop="mainContentOfPage" tabindex="-1">

  <?php
  the_post();
  $categories = get_the_terms( get_the_ID(), 'category' );
  // $duration = get_field( 'duration' );
  // $mp3_url = get_field( 'mp3_url' );
  $title = get_the_title();
  $link = get_the_permalink();
  ?>
  <section class="gutter-l gutter-r back-link-wrapper">
    <a href="<?= get_field( 'page_for_posts', 'options' ); ?>" class="label back-link">
      <?php the_module('svg', array(
        'icon' => 'icon-angle-left',
        'class' => 'icon-angle-left back-link-icon'
        )); ?>
      <span class="back-link-text">See More Posts</span>
    </a>
  </section>
  <section class="post gutter-l gutter-r gutter-b--small">
    <div class="post__image">
      <div class="post__image__inner">
        <?php the_module('image', array(
            'image' => get_post_thumbnail_id(),
            'class' => 'post__image__image',
            'cover' => true
          )); ?>
      </div>
    </div>
    <div class="post__content container-s"><?php
      $cat_label = null;
      $cats_arr = [];
      if(!empty($categories) && !is_wp_error($categories)) {
        foreach($categories as $category) {
          $cats_arr[] = $category->name;
        }
        $cat_label = '<p class="label red sup">'.implode($cats_arr, ', ').'</p>';
      }
      echo $cat_label;

      if(get_field('event_date')){
        $title .= '<br><small>'.get_field('event_date').'</small>';
      }

      echo '<h1 class="title h2">'.$title.'</h1>';
      
      if(get_field('venue_info')){
        echo '<small class="post__venue-info">'.get_field('venue_info').'</small>';
      }
      
      if(get_field('tickets_link')){
        $tickets = get_field('tickets_link');
        echo '<a href="'.$tickets['url'].'" target="'.$tickets['target'].'" class="post__tickets-button button">'.$tickets['title'].'</a>';
      }?>

      <div class="post__meta gutter-t gutter-t--small">
        <?= (!get_field('event_date')) ? '<span class="post__meta__item label">'.get_the_date('F j, Y').'</span>' : null; ?>
        <span class="post__meta__item label">
          Share
          <a class="post__meta__social__link" target="_blank" href="<?= 'https://www.facebook.com/sharer/sharer.php?u='.urlencode($link); ?>" title="<?= __('Share this on Facebook', 'mvl'); ?>">
            <?php the_module('svg', array(
              'icon' => 'icon-facebook',
              'class' => 'icon-facebook post__meta__social__icon'
              )); ?>
          </a>
          <a class="post__meta__social__link" target="_blank" href="<?= 'https://twitter.com/home?status='.urlencode($link); ?>" title="<?= __('Share this on Twitter', 'mvl'); ?>">
            <?php the_module('svg', array(
              'icon' => 'icon-twitter',
              'class' => 'icon-twitter post__meta__social__icon'
              )); ?>
          </a>
          <a class="post__meta__social__link" href="<?= 'mailto:?subject='.esc_attr($title).'&body='.urlencode($link); ?>" title="<?= __('Share this by Email', 'mvl'); ?>">
            <?php the_module('svg', array(
              'icon' => 'icon-envelope',
              'class' => 'icon-envelope post__meta__social__icon'
              )); ?>
          </a>
        </span>
      </div><?php

      the_module('content', array(
        'class' => 'gutter-t gutter-t--small'
        )); ?>
    </div>
    
  </section><?php

  if( have_rows('gallery_images') ){
    $images = [];
    while ( have_rows('gallery_images') ) {
      the_row();
      $images[] = get_sub_field('image');
    }
    the_module('carousel', [
      'images' => $images,
      'heading' => get_field('gallery_heading') ? get_field('gallery_heading') : null,
      'description' => get_field('gallery_description') ? get_field('gallery_description') : null
    ]);
  }?>
  <?php
    $related = get_posts( array(
      'category__in' => wp_get_post_categories($post->ID),
      'numberposts' => 3,
      'post__not_in' => array($post->ID)
    ));
    if( $related ) {

      // Use post-rows module here
      the_module('post-rows', [
        'side_header' => 'Related',
        'categories' => wp_get_post_categories($post->ID),
        'post_count' => 3,
        'exclude' => array($post->ID)
      ]);

    } ?>

</main>
<?php get_footer(); ?>

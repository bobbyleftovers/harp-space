<?php
$header = $header ? $header : null;
$subheader = $subheader ? $subheader : null;
$side_header = $side_header ? $side_header : null;
$cta = $cta ? $cta : null;
$pagination = $pagination || false;

$args = [
  'post_type' => 'post',
  'posts_per_page' => $post_count ? $post_count : 3
];

if ($categories) {
  $args['category__in'] = $categories;
}

if ($exclude) {
  $args['post__not_in'] = $exclude;
}

$posts = new WP_Query($args);?>

<section class="post-rows container-xl container" data-module="post-rows">
  <?= $header ? '<h2 class="post-rows__header">'.$header.'</h2>' : null ?>
  <?= $side_header ? '<span class="post-rows__header section-heading">'.$side_header.'</span>' : null ?>
  <?= $subheader ? '<p class="post-rows__subheader section-subheading">'.$subheader.'</p>' : null ?>
  <ul class="post-rows__posts"><?php
    while($posts->have_posts()){
      $posts->the_post();
      the_module('post-card');
    } ?>
  </ul><?php
  if($cta){ ?>
    <div class="post-rows__cta">
      <a class="button" href="<?= $cta['url'] ?>" title="<?= $cta['title'] ?>"><?= $cta['title'] ?></a>
    </div><?php
  }
  if ($pagination) {?>
    <div class="post-rows__pagination"><?php
      echo paginate_links( array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'        => $posts->max_num_pages,
        'current'      => max( 1, get_query_var( 'paged' ) ),
        'format'       => '?paged=%#%',
        'show_all'     => false,
        'type'         => 'plain',
        'end_size'     => 2,
        'mid_size'     => 1,
        'prev_next'    => true,
        'prev_text'    => sprintf( '<i></i> %1$s', '<<<' ),
        'next_text'    => sprintf( '%1$s <i></i>', '>>>' ),
        'add_args'     => false,
        'add_fragment' => '',
      ) ); ?>
    </div><?php
    
  } 
  wp_reset_postdata();?>
</section>

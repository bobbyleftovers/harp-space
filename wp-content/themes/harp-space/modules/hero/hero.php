<?php
$image = !empty($image) ? $image : get_the_post_thumbnail_url( $post->ID, 'large' );
$content = false;
if(get_field('add_title_subhead')){
  $content = '<div class="hero__content">';
  $content .= get_field('header') ? '<h1 class="hero__header">'.get_field('header').'</h1>' : null;
  $content .= get_field('subheader') ? '<p  class="hero__subheader">'.get_field('subheader').'</p>' : null;
  $content .= '</div>';
}

if( !empty($image) ) :?>
  <section class="hero <?= $class; ?>"><?php
    the_module('image', array(
      'image' => $image,
      'class' => 'hero__image',
      'cover' => true,
      'content' => $content
    ));?>
  </section><?php
endif; ?>

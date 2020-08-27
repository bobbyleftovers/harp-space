<?php
  /*
  Template Name: Home
  Template Post Type: page
  */
?>
<?php get_header(); ?>
<main id="main_content" itemprop="mainContentOfPage" tabindex="-1"><?php

  if ( get_field('hero_image')) {
    the_module('hero', array(
      'class' => 'hero--home',
      'image' => get_field('hero_image'),
      'image_mobile' => get_field('hero_mobile_image')
    ));
  }

  if( have_rows('page_features') ):
    while ( have_rows('page_features') ) : the_row();
      switch(get_row_layout()){
        case 'page_intro':
          the_module('text-image', array(
            'class' => 'text-image--left',
            'section_heading' => get_sub_field('side_header'),
            'header' => get_sub_field('header'),
            'subheader' => get_sub_field('subheader'),
            'body' => get_sub_field('body'),
            'image' => get_sub_field('image'),
            'align' => get_sub_field('image_alignment')
          ));
        break;
        case 'cards':
          the_module('post-rows', array(
            'categories' => get_sub_field('card_categories'),
            'post_count' => get_sub_field('post_count'),
            'side_header' => get_sub_field('side_header'),
            'header' => get_sub_field('card_section_title'),
            'subheader' => get_sub_field('card_section_subheader'),
            'cta' => get_sub_field('cta')
          ));
        break;
      }
    endwhile;
  endif;
  if ( get_field('show_contact_form')) {
    the_module('contact-form', array(
      'class' => 'hero--home',
      'image' => get_field('hero_image'),
      'image_mobile' => get_field('hero_mobile_image')
    ));
  }

  if ( get_field('show_social_links')) {
    the_module('social-links', array(
      'class' => 'hero--home',
      'image' => get_field('hero_image'),
      'image_mobile' => get_field('hero_mobile_image')
    ));
  }?>
</main>
<?php get_footer(); ?>

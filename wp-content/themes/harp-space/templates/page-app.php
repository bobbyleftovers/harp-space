<?php
  /*
  Template Name: Single-page App
  Template Post Type: page
  */
?>
<?php get_header(); ?>
<main id="main_content" itemprop="mainContentOfPage" tabindex="-1"><?php
  the_module('hero', array(
    'class' => 'hero--home',
    'image' => carbon_get_the_post_meta('cover_art'),
    'liner_eyebrow' => carbon_get_the_post_meta('liner_eyebrow'),
    'secondary_image' => carbon_get_the_post_meta('secondary_image'),
    'h1' => carbon_get_the_post_meta('main_title'),
    'h1_eyebrow' => carbon_get_the_post_meta('title_eyebrow'),
    'h1_image' => carbon_get_the_post_meta('title_image'),
    'cover_subhead' => carbon_get_the_post_meta('cover_art_subheader'),
    'copy' => apply_filters( 'the_content',carbon_get_the_post_meta('hero_copy')),
    'link_set' => carbon_get_the_post_meta('listen_links')
  ));?>
  <section id="music" class="content-section"><?php
    the_module('music', array(
      'header' => carbon_get_the_post_meta('music_header')
    ));?>
  </section>
  <section id="video" class="content-section"><?php
    // echo carbon_get_the_post_meta('video_title');
    the_module('video', array(
      'header' => carbon_get_the_post_meta('video_title'),
      'video' => carbon_get_the_post_meta('video_embed')
    ));?>
  </section>
  <section id="poll">
    <div class="container container--sm">
      <!-- test -->
      <?=  get_poll(2); ?>
    </div>
  </section>
  <section id="contact" class="content-section"><?php
    the_module('contact', array(
      'header' => carbon_get_the_post_meta('contact_title'),
      'shortcode' => carbon_get_the_post_meta('contact_shortcode')
    )); ?>
  </section>
</main>
<?php get_footer(); ?>

<?php
  /*
  Template Name: Posts
  Template Post Type: page
  */
?>
<?php
$current_cat = $_POST['category'] && $_POST['category'] != 0 ? $_POST['category'] : null;
$categories = get_categories();
// print_r($_POST);
// echo $current_cat;

get_header(); ?>
<main id="main_content" itemprop="mainContentOfPage" tabindex="-1"><?php

  if ( get_field('hero_image')) {
    the_module('hero', array(
      'class' => 'hero--home',
      'image' => get_field('hero_image')
    ));
  }?>

  <section class="filters">
    <div class="container container-s">
      <form action="<?= get_the_permalink() ?>" method="post">
        <?php //print_r(get_categories());?>
        <div class="select-wrapper">
          <select name="category" id="category">
            <option value="0" <?= $current_cat ? null : 'selected' ?>>Choose a category</option><?php
            foreach($categories as $cat){
              $is_selected = $cat->term_id == $current_cat ? 'selected' : null;
              echo '<option value="'.$cat->term_id.'" '.$is_selected.'>'.$cat->id.$cat->name.'</option>';
            }?>
          </select>
        </div>
        <input class="button" type="submit" />
      </form>
    </div>
  </section>
  <div class="posts"><?php
    $args = [
      'post_count' => 12,
      'pagination' => true
    ];

    if($current_cat){
      $args['categories'] = $current_cat;
    }
    the_module('post-rows', $args);?>
  </div><?php

 
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

<?php
/**
 * Blank 404 file
 *
 */
?>
<?php get_header(); ?>
<main id="main_content" class="" itemprop="mainContentOfPage" tabindex="-1">

    <?php the_module('intro', array(
        'class' => 'gutter-t',
        'title' => get_field('404_headline', 'options')
    )); ?>
    <?php the_module('content', array(
        'class' => 'gutter',
        'content' => get_field('404_content', 'options')
    )); ?>

</main>
<?php get_footer(); ?>

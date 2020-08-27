<?php get_header(); ?>
<main id="main_content" class="" itemprop="mainContentOfPage" tabindex="-1">

  <?php 
    the_post();
    $type = get_the_terms( $event, 'event_types' );
    $back = get_field( 'back_to_retreats_page', 'options' );
  ?>
  <?php if( !empty($back) ): ?>
    <section class="gutter-l gutter-r back-link-wrapper">
      <a href="<?= get_the_permalink($back->ID); ?>" class="label back-link">
      <?php the_module('svg', array(
            'icon' => 'icon-angle-left',
            'class' => 'icon-angle-left back-link-icon'
        )); ?>
        <span class="back-link-text"><?= __('Back to', 'mvl').' '.$back->post_title; ?></span>
      </a>
    </section>
  <?php endif; ?>
  <section class="intro intro--small content gutter-l gutter-r gutter-t--small gutter-b--small">
    <?php if(!empty($type)): ?>
      <p class="label alternating-two-ups-label red sup"><?= $type[0]->name; ?></p>
    <?php endif; ?>
    <h1 class="title"><?= get_the_title() ?></h1>
  </section>
  <?php the_module('carousel', array(
        'class' => 'gutter-b--small'
    )); ?>
  <?php the_module('tab-content', array(
        'class' => 'gutter-b gutter-l gutter-r'
    )); ?>

</main>
<?php get_footer(); ?>

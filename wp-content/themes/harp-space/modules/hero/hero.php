<?php
$bk_image = wp_get_attachment_image_src( carbon_get_theme_option( 'background_image' ), 'full' )[0];
$listen_links = '';

if (carbon_get_the_post_meta( 'show_listen_links' )) {
  $listen_links = '<h2 class="hero__cover-subhead">'.$cover_subhead.'</h2><div class="hero__link-set">';
  foreach($link_set as $link){
    $listen_links .= '<a href="'.$link['listen_url']['url'].'" class="link-set__link" target="_blank">';
    $listen_links .= get_module('image', array(
      'image' => $link['icon'],
      'class' => 'link-set__image',
      'contain' => true
    ));
    $listen_links .= '</a>';
  }
  $listen_links .= '</div>';
}
?>

<section class="hero <?= $class; ?>" data-module="hero" style="background-image: url('<?= $bk_image ?>')">
  <div class="container hero__inner">
    <div class="hero__cover"><?php
      the_module('image', array(
        'image' => $image,
        'class' => 'hero__image',
        'content' => $listen_links
      ));?>
    </div>
    <div class="hero__details">
        <span class="details__eyebrow"><?= $h1_eyebrow ?></span><?php
        the_module('image', array(
          'image' => $h1_image,
          'class' => 'details__title-img'
        ));?>
        <div class="details__copy"><?= $copy ?></div>
        <a href="<?= carbon_get_the_post_meta('pdf_download') ?>" target="_blank" class="details__download"><?php
          the_module('image', array(
            'image' => $secondary_image,
            'class' => 'details__liner-notes',
            'content' => '<span class="details__copy-eyebrow">'.$liner_eyebrow.'</span>'
          ));?>
        </a>
        
        <div class="details__cta"><?php
          $cta = carbon_get_the_post_meta('hero_cta'); ?>
          <h2 class="details-cta__header"><?= carbon_get_the_post_meta('hero_cta_header') ?></h2>
          <a href="<?= $cta['url'] ?>" target="_blank" class="button"><?= $cta['anchor'] ?></a>
          <span class="details-cta__subheader"><?= carbon_get_the_post_meta('hero_cta_subheader') ?></span>
        </div>
    </div>
  </div>
</section>
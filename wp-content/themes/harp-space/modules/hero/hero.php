<section class="hero <?= $class; ?>">
  <div class="container hero__inner">
    <div class="hero__cover"><?php
      the_module('image', array(
        'image' => $image,
        'class' => 'hero__image',
        'contain' => true
      ));?>
      <h2 class="hero__cover-subhead"><?= $cover_subhead ?></h2>
      <div class="hero__link-set"><?php
        foreach($link_set as $link){
          echo '<a href="" class="link-set__link">';
          the_module('image', array(
            'image' => $link['icon'],
            'class' => 'link-set__image',
            'contain' => true
          ));
          echo '</a>';
        }?>
      </div>
    </div>
    <div class="hero__details">
        <span class="details__eyebrow"><?= $title_eyebrow ?></span><?php
        the_module('image', array(
          'image' => $h1_image,
          'class' => 'details__title-img'
        ));?>
        <span class="details__copy-eyebrow"><?= $liner_eyebrow ?></span><?php
        the_module('image', array(
          'image' => $secondary_image,
          'class' => 'details__title-img'
        ));?>
        <div class="details__copy"><?= $copy ?></div>
        <div class="details__cta"><?php
          $cta = carbon_get_the_post_meta('hero_cta'); ?>
          <h2 class="details-cta__header"><?= carbon_get_the_post_meta('hero_cta_header') ?></h2>
          <span class="details-cta__subheader"><?= carbon_get_the_post_meta('hero_cta_subheader') ?></span>
          <a href="<?= $cta['url'] ?>" target="_blank" class="button"><?= $cta['anchor'] ?></a>
        </div>
    </div>
  </div>
</section>
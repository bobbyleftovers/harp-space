<?php
$section_heading = !empty($section_heading) ? $section_heading : null;
$header = !empty($header) ? $header : null;
$subbheader = !empty($subbheader) ? $subbheader : null;
$body = !empty($body) ? $body : null;
$cta = !empty($cta) ? $cta : null;
$image = !empty($image) ? $image : null;
?>

<section class="text-image container-l container <?= $class; ?>">
  
  <?php if(!empty($image)):
    // print_r($image);?>
    <div class="text-image__image-wrap">
      <?php the_module('image', array(
        'image' => $image,
        'class' => 'text-image__image',
        'cover' => true
      )); ?>
    </div>
  <?php endif; ?>

  <div class="text-image__text">
    <?php if(!empty($section_heading)): ?>
      <div class="section-heading"><?= $section_heading; ?></div>
    <?php endif;
    if(!empty($header)): ?>
      <h1 class="h2 text-image__title container-s"><?= $header ?></h1>
    <?php endif;
    if(!empty($body)): ?>
      <div class="wysiwyg container-s text-image__text"><?= $body; ?></div>
    <?php endif;
    if(!empty($cta)): ?>
      <a href="<?= $cta; ?>" class="button button--white text-image__button"><?= $cta; ?></a>
    <?php endif; ?>
  </div>

</section>
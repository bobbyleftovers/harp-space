<?php
if(!empty($video)) :
?>
  <div class="video container <?= $class; ?>" tabindex="-1">
    <?= $header ? '<h2 class="section-header video__header">'.$header.'</h2>' : null ?>
    <div class="video__wrap"><?= get_video_oembed( $video, $attr, 'js-video' ) ?></div>
  </div>
<?php
endif;
?>

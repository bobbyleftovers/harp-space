<?php
if(!empty($video)) :
?>
  <div class="video container <?= $class; ?>" data-module="video" tabindex="-1">
    <?= $header ? '<h2 class="video__header">'.$header.'</h2>' : null ?>
    <?= get_video_oembed( $video, $attr,'js-video' ); ?>
  </div>
<?php
endif;
?>

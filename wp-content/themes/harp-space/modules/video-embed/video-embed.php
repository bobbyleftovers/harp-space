<?php
if(!empty($video)) :
?>
  <div class="video-embed <?= $class; ?>" data-module="video-embed" tabindex="-1">
    <?= get_video_oembed( $video, $attr,'js-video' ); ?>
    <?php if($mute) : ?>
        <button class="video__volume js-video-volume-toggle" aria-label="<?= __('Toggle video audio', 'mvl'); ?>">
            <?php the_module('svg', array(
                'icon' => 'icon-volume-on',
                'class' => 'icon-volume-on video__volume__icon'
            )); ?>
            <?php the_module('svg', array(
                'icon' => 'icon-volume-off',
                'class' => 'icon-volume-off video__volume__icon'
            )); ?>
        </button>
    <?php endif; ?>
  </div>
<?php
endif;
?>

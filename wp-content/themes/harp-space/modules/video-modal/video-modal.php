<?php
if(!empty($video) && !empty($modal_id) ) :
?>
<div class="video-modal js-overlay" id="<?= $modal_id; ?>" role="dialog" aria-labelledby="trigger-<?php echo $modal_id; ?>">
  <div class="container video-modal__inner">
    <button class="video-modal__close js-close" aria-label="<?= __('Close video', 'mvl'); ?>" tabindex="0">
        <?php the_module('svg', array(
            'icon' => 'icon-times',
            'class' => 'icon-times video-icon-close'
            )); ?>
        </button>
        <div class="video-modal__content" tabindex="1">
            <?php the_module('video-embed', array(
                'video' => $video,
                'class' => 'video-modal__video js-video-iframe-wrapper'
                )); ?>
        </div>
    </div>
</div>
<?php endif; ?>

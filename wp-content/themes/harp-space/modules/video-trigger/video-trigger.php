<?php if(!empty($video)) :
  $modal_id = uniqid('modal-');
  $play_cta = get_field('video_play_cta_text');
?>
  <div class="video-trigger <?= $class; ?>">
    <div class="video-trigger__inner">
      <a href="#<?= $modal_id; ?>" id="trigger-<?= $modal_id; ?>" aria-label="<?= __('Play video', 'mvl'); ?>" data-module="video-modal" class="video-link">
        <?php
          the_module('image', array(
            'image' => $image,
            'class' => 'video-trigger__image',
            'cover' => true
          ));
        ?>
        <div class="icon-play video-trigger__button">
          <?php the_module('svg', array(
              'icon' => 'icon-play-diamond',
              'class' => 'icon-play-diamond video-icon'
          )); ?>
          <?php if(!empty($play_cta)): ?>
            <div class="label underline"><?= $play_cta; ?></div>
          <?php endif; ?>
        </div>
      </a>
      <?php the_module('video-modal', array(
        'video' => $video,
        'modal_id' => $modal_id
      )); ?>
    </div>
  </div>
<?php endif; ?>

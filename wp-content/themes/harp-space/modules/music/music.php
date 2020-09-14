<?php
$args = array(
	'post_type' => 'track',
	'posts_per_page' => -1
);

$tracks = new WP_Query($args);?>

<div class="music container" data-module="music">
	<?= $header ? '<h2 class="section-header music__header">'.$header.'</h2>' : null?>
	<div class="music__previews"><?php
		if($tracks->have_posts())	{
			$i = 1;
			while($tracks->have_posts()){
				$tracks->the_post();
				if(carbon_get_the_post_meta('add_preview') === 'yes') { ?>
					<div class="preview">
						<span class="preview__header">Preview <?= $i < 10 ? '0'.$i : $i ?></span>
						<div class="preview__track-info">
							<span class="preview__info">
								<button class="audio-btn preview__play"><i class="far fa-play-circle"></i></button>
								<button class="audio-btn preview__pause"><i class="far fa-pause-circle"></i></button>
							
								<span class="preview__title"><?= get_the_title();?></span>
								<span class="preview__artist"><?= carbon_get_the_post_meta('track_artist'); ?></span>
							</span>
							<audio class="preview__audio">
								<source src="<?= wp_get_attachment_url(carbon_get_the_post_meta('ogg_track')) ?>" type="audio/ogg">
								<source src="<?= wp_get_attachment_url(carbon_get_the_post_meta('mp3_track')) ?>" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio>
							<span class="preview__timer">00:00</span>
						</div>
					</div><?php
					$i++;
				}
				
			}
			wp_reset_postdata();
		} ?>
	</div>
	
	<div class="music__track-listing">
		<button class="btn btn-toggle-list">View Track Listing</button>
		<div class="list__wrap"><?php
			if($tracks->have_posts())	{
				while($tracks->have_posts()){
					$tracks->the_post();
					$credits = carbon_get_the_post_meta('track_credits'); ?>
					<div class="list__item">
						<span class="list__index"> TRACK <?= carbon_get_the_post_meta('track_number') ?></span>
						<span class="list__title"><?= get_the_title() ?></span>
						<div class="list__credits"><?php
							foreach($credits as $credit){?>
								<span class="list__credit"><?= $credit['artist_name'] ?><?= $credit['artist_instrument'] != '' ? ', '.$credit['artist_instrument'] : null ?></span><?php
							}?>
						</div>
						<span class="list__duration"> Length <?= carbon_get_the_post_meta('track_duration') ?></span>
					</div><?php
				}
				wp_reset_postdata();
			}?>
		</div>
	</div>
</div>
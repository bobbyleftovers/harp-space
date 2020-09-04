<?php
$args = array(
	'post_type' => 'track',
	'posts_per_page' => -1
);

$tracks = new WP_Query($args);?>

<div class="music container">
	<?= $header ? '<h2 class="contact__header">'.$header.'</h2>' : null?>
	<div class="music__previews">
	<?php
	if($tracks->have_posts())	{
		while($tracks->have_posts()){
			$tracks->the_post();
			if(carbon_get_the_post_meta('add_preview') === 'yes') {
				echo carbon_get_the_post_meta('track_artist');
				the_title();
				echo carbon_get_the_post_meta('track_duration');
			}
			
		}
		wp_reset_postdata();
	} ?>
	</div>
	<button class="btn btn-secondary">View Track Listing</button>
	<div class="music__track-listing">

	</div>
</div>
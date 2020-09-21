<?php
$classes = isset($classes) ? $classes : null
?>

<div class="contact container container--sm">
	<?= $header ? '<h2 class="section-header contact__header">'.$header.'</h2>' : null?>
	<div class="contact__content"><?= $shortcode ? do_shortcode($shortcode) : null ?></div>
</div>
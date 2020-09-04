<?php
$classes = isset($classes) ? $classes : null
?>

<div class="contact container">
	<?= $header ? '<h2 class="contact__header">'.$header.'</h2>' : null?>
	<div class="contact__content"></div><?= $shortcode ? do_shortcode($shortcode) : null ?></div>
</div>
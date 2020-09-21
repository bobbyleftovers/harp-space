<?php
$content = $content ?? get_the_content();
if( !empty($content) ) : ?>
    <article class="content container-s wysiwyg <?= $class ?>">
      <?= $content; ?>
    </article>
<?php endif; ?>

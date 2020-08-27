<?php get_header(); ?>
<?php

$archive_page_id = get_option( 'page_for_posts' );
$archive_page_url = get_the_permalink( $archive_page_id );

$category_id = get_query_var( 'cat' );

$categories = get_terms(array(
    'taxonomy' => 'category',
    'hide_empty' => false
));

array_unshift($categories, (object) array(
    'name' => __( 'All', 'mvl' ),
    'link' => $archive_page_url
));

?>
<?php if ( !empty($archive_page_id) ) : ?>
    <?php
        $archive_page = get_post( $archive_page_id );
        if ( !empty($archive_page) ) :
            global $post;
            $post = $archive_page;
            setup_postdata( $archive_page ); ?>

            <?php the_module('intro', array(
                'class' => 'gutter-t intro--podcast'
            )); ?>

            <div class="podcast__header gutter-l gutter-r">
                <div class="section-heading section-heading--horizontal"><?= __( 'Latest Episode', 'mvl' ); ?></div>

                <?php if(!empty($categories)): ?>
                <nav class="podcast__nav">
                  <ul>
                  <?php foreach($categories as $cat): ?>
                    <?php
                      $active = $cat->term_id == $category_id;
                      $link = !empty($cat->link) ? $cat->link : get_category_link($cat->term_id);
                    ?>
                    <li>
                      <a class="podcast__nav__link <?= $active ? 'is-active' : ''; ?>" href="<?= esc_url( $link ); ?>"><?= esc_html( $cat->name ); ?></a>
                    </li>
                  <?php endforeach; ?>
                  </ul>
                </nav>
                <div class="podcast__nav__mobile select-wrapper">
                    <select class="select" onchange="document.location=this.value">
                      <?php foreach($categories as $cat): ?>
                        <?php
                            $active = $cat->term_id == $category_id;
                            $link = !empty($cat->link) ? $cat->link : get_category_link($cat->term_id);
                        ?>
                        <option <?= $active ? 'selected' : ''; ?> value="<?= esc_url( $link ); ?>"><?= esc_html( $cat->name ); ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php the_module('svg', array(
                        'icon' => 'icon-angle-down',
                        'class' => 'icon-angle-down select-icon'
                    )); ?>
                </div>
                <?php endif; ?>

            </div>

    <?php endif; ?>
<?php endif; ?>

    <main id="main_content" role="main" class="podcast__content gutter-l gutter-r top-border" itemprop="mainContentOfPage" tabindex="-1">

        <?php if ( have_posts() ) : ?>
            <ul class="podcast__grid">

                <?php while ( have_posts() ) : ?>
                    <?php
                        the_post();
                        the_module('post-card');
                    ?>
                 <?php endwhile; ?>
            </ul>

            <?php the_module('load-more', array(
                'update_selector' => '.podcast__grid'
            )); ?>

        <?php else : ?>
            <section class="gutter">
                <p><?= __( 'There is nothing to see here yet, check back soon!', 'mvl' );?></p>
            </section>
        <?php endif; ?>

    </main>
<?php
get_footer();

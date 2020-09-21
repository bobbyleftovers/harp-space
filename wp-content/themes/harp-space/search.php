<?php get_header(); ?>
<main id="main_content" class="" itemprop="mainContentOfPage" tabindex="-1">

  <section class="container-s gutter search">
    <?php
    global $wp_query;

    $results_count = $wp_query->found_posts;
    $results_str = __(' results for ', 'mvl');
    if( $results_count == 1 ) :
        $results_str = __(' result for ', 'mvl');
    endif;

    $results_str = sprintf(
        '%s %s “%s”',
        $results_count,
        $results_str,
        get_search_query()
    );
    ?>

    <div class="intro intro--search-results">
        <h1><?= __('Search Results', 'mvl'); ?></h1>
    </div>

    <?php
        the_module('search-form', array(
              'class' => 'search-form--search-results'
        ));
    ?>

    <p class="search__total small"><?= $results_str; ?></p>
    <?php if (have_posts()) : ?>
    <div class="search__results">
        <?php while (have_posts()) : the_post(); ?>
            <div class="search__result top-border top-border--full">
                <h2 class="h3 search__result__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <p class="small"><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="link"><?= __('Learn More', 'mvl'); ?></a>
            </div>
        <?php endwhile; ?>
    </div>
    <?php wp_reset_query(); endif; ?>

    <div class="search__more">
        <?php the_module('load-more', array(
            'update_selector' => '.search__results'
        )); ?>
    </div>

  </section>

</main>
<?php get_footer(); ?>

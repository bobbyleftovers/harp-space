<?php

/**
 * Get the size-specific URL for an image attachment.
 * @param  int $id   ID of the image
 * @param  string $size Size name
 * @return string       URL to the correctly sized image, empty if not found
 */
function get_image_with_size( $id, $size ) {
    $img = wp_get_attachment_image_src( $id, $size );

    if ( $img ) {
        return $img[0];
    }

    return '';
}

/**
 * Shortcut to get correctly sized image URL based on custom field name
 * @param  string $name Name of custom field
 * @param  string $size Size
 * @return string       URL
 */
function get_image_field_with_size( $name, $size ) {
    return get_image_with_size( get_field( $name ), $size );
}

/**
 * Shortcut to get correctly sized image URL based on custom sub field name
 * @param  string $name Name of custom field
 * @param  string $size Size
 */
function get_image_sub_field_with_size( $name, $size ) {
    return get_image_with_size( get_sub_field( $name ), $size );
}

/**
 * Output correctly sized image URL based on attachment ID
 * @param  int $id ID of the image
 * @param  string $size Size
 */
function the_image_with_size( $id, $size ) {
    echo get_image_with_size( $id, $size );
}

/**
 * Output correctly sized image URL based on custom field name
 * @param  string $name Name of custom field
 * @param  string $size Size
 */
function the_image_field_with_size( $name, $size ) {
    echo get_image_field_with_size( $name, $size );
}

/**
 * Output correctly sized image URL based on custom sub field name
 * @param  string $name Name of custom field
 * @param  string $size Size
 */
function the_image_sub_field_with_size( $name, $size ) {
    echo get_image_sub_field_with_size( $name, $size );
}

/**
 * Get the correctly sized URL of the featured post image.
 * @param  string $size Size
 * @return string       URL
 */
function get_thumbnail_url_with_size( $size ) {
    $img = wp_get_attachment_image_src( get_post_thumbnail_id(), $size );

    if ( $img ) {
        return $img[0];
    }

    return '';
}

/**
 * Output the correctly sized URL of the featured post image.
 * @param  string $size Size
 * @return string       URL
 */
function the_thumbnail_url_with_size( $size ) {
    echo get_thumbnail_url_with_size( $size );
}

/**
 * Videos embedded in WYSIWYG needs to be wrapped with a div class in order to
 * make sure it's responsive.
 */
function wysiwyg_responsive_video() {
    add_filter('embed_oembed_html', 'wrap_oembed_video', 10, 3);
}

/**
 * Wrap a chunk of HTML code within a wrapper class, can be used for responsive
 * @param  string $html HTML output of the video (iframe, embed etc.)
 * @return string       Wrapped HTML output
 */
function wrap_oembed_video( $html ) {
    return '<div class="rte__video-wrapper">' . $html . '</div>';
}

/**
 * Responsive background images (originally from esny)
 * @internal - `<style scoped>` has been removed from the spec, which
 * technically makes this invalid HTML. The alternative is to move these
 * declarations to the HEAD. Another possible solution would be to add
 * each of these to the footer such that they can be inserted into the
 * DOM with javascript. Another alternative is to use the `image-set`
 * CSS notation in pure styles. @see http://caniuse.com/#feat=css-image-set
 */
function the_image_bg_style( $id, $selector, $sizes = array(), $breakpoints = array(), $hd = true ) {
    if ( empty( $breakpoints ) ) {
        $breakpoints = array(
            0,
            450,
            850
        );
    }
    if ( empty( $sizes ) || count( $sizes )  < count( $breakpoints ) ) {
        $sizes = array(
            array( 320 ),
            array( 480 ),
            array( 800 )
        );
    }

    if ( $hd ) {
        foreach ( $sizes as $key => $size ) {
            $sizes[$key][0] = $size[0] * 2;
            if ( count( $size ) > 1 ) {
                $sizes[$key][1] = $size[1] * 2;
            }
        }
    }

    echo '<style type="text/css" scoped>';

    foreach ( $breakpoints as $key => $break ) {
        $image = get_image_with_size( $id, $sizes[$key] );

        if ( ! $image ) {
            continue;
        }

        if ( $key !== 0 ) {
            echo '@media (min-width: ' . $break . 'px) { ';
            echo $selector . ' { background-image: url("' . $image . '"); }';
            echo " }\n";
        } else {
            echo $selector . ' { background-image: url("' . $image . '"); }' . "\n";
        }
    }

    echo '</style>';
}

function the_image_field_bg_style( $field, $selector, $sizes = array(), $breakpoints = array() ) {
    the_image_bg_style( get_field( $field ), $selector, $sizes, $breakpoints );
}

function the_image_sub_field_bg_style( $field, $selector, $sizes = array(), $breakpoints = array() ) {
    the_image_bg_style( get_sub_field( $field ), $selector, $sizes, $breakpoints );
}

function get_image_srcset( $id ) {
    return force_ssl_protocol( wp_get_attachment_image_srcset( $id ) );
}

function the_image_srcset( $id ) {
    echo get_image_srcset( $id );
}

function get_image_sizes_attribute( $id ) {
    return wp_get_attachment_image_sizes( $id );
}

function the_image_sizes_attribute( $id ) {
    echo get_image_sizes_attribute( $id );
}

function get_video_element($url = '', $attrs = '', $classes = '') {
    return '<video src="'.$url.'" class="'.$classes.'"'.$attrs.'></video>';
}

function the_video_element($url = '', $attrs = '', $classes = '') {
    echo get_video_element($url, $attrs, $classes);
}

function get_video_oembed($oembed, $params, $class = '') {
    if ( preg_match('/src="(.+?)"/', $oembed, $matches) ) {
        $src = $matches[1];
        $params = !empty($params) ? $params : array();
        array_push($params, 'api=1');
        $video_id = uniqid('video-');
        $new_src = add_query_arg($params, $src);
        $oembed = str_replace($src, $new_src, $oembed);
        $oembed = str_replace('iframe', 'iframe id="' . $video_id . '" class="' . $class . '"', $oembed);
        $oembed = str_replace( 'frameborder="0"', '', $oembed );
    }
    return $oembed;
}

/**
 * Construct and return an image tag for lazy-loading
 *
 * @param array $image
 * @param string $size
 * @param string $class
 * @param string $sizes
 * @param string $alt
 */
function the_lazy_img( $image, $size, $class, $sizes = '', $alt ) {
    if( is_array($image) ) {
    $id = $image['ID'];
    $img = wp_get_attachment_image_src( $id, $size )[0];
    } elseif (is_numeric($image)) {
    $id = $image;
    $img = wp_get_attachment_image_src( $id, $size )[0];
    } else {
    $id = null;
    $img = $image;
    }

    if ( !empty( $id ) && empty( $alt ) ) {
    $alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
    }

    if ( empty( $img ) ) {
    return;
    }

    $blank = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
    $html = '<img %s src="%s" data-normal="%s" data-retina="%s" data-srcset="%s" alt="%s" %s>';

    printf(
    $html,
    empty( $class ) ? '' : "class=\"${class}\"",
    $blank,
    $img,
    $img,
    wp_get_attachment_image_srcset($id, $size) ? wp_get_attachment_image_srcset($id, $size) : $img,
    $alt,
    empty( $sizes ) ? '' : "sizes=\"${sizes}\""
    );
}

/*
 * Enable SVG media uploads
 */
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
  $filetype = wp_check_filetype( $filename, $mimes );
  return [
    'ext'             => $filetype['ext'],
    'type'            => $filetype['type'],
    'proper_filename' => $data['proper_filename']
  ];
}, 10, 4 );

add_filter( 'upload_mimes', function ($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
});

add_action( 'admin_head', function () {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
            width: 100% !important;
            height: auto !important;
        }
        </style>';
});

<?php

add_shortcode( 'icon-fire', function ( $atts, $content = "" ) {
    return get_module('svg', array(
        'icon' => 'icon-fire',
        'class' => 'icon-fire shortcode-fire'
    ));
});
function currentyear() {
    return date("Y");
};
add_shortcode( 'currentyear', 'currentyear');
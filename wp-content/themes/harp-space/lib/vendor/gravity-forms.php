<?php
// Move gravity forms scripts into the footer
add_filter( 'gform_init_scripts_footer', '__return_true' );

// Change default tabindex from -1 to 0
add_filter( 'gform_tabindex', function ( $tabindex, $form ) {
    return 0;
}, 10, 2 );

// Prevent forms from auto scrolling after ajax submission
add_filter( 'gform_confirmation_anchor', '__return_false' );

// Disable auto complete
add_filter( 'gform_form_tag', function ( $form_tag, $form ) {
    if ( is_admin() ) return $form_tag;
    $form_tag = str_replace( '>', ' autocomplete="off">', $form_tag );
    return $form_tag;
}, 11, 2 );
add_filter( 'gform_field_content', function ( $input, $field, $value, $lead_id, $form_id ) {
    if ( is_admin() ) return $input;
    $input = preg_replace( '/<(input|textarea)/', '<${1} autocomplete="off" ', $input );
    return $input;
}, 11, 5 );

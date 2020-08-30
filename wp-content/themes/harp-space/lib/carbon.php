<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'attach_theme_options' );
add_action( 'carbon_fields_register_fields', 'attach_page_fields' );
add_action( 'carbon_fields_register_fields', 'attach_track_fields' );

function attach_theme_options() {
    Container::make( 'theme_options', 'Theme Options' )
        ->add_tab( 'Site Info', array(
            Field::make( 'text', 'album_title', 'Album Title' ),
            Field::make( 'image', 'logo', 'Logo' ),
            Field::make( 'textarea', 'copyright', 'Copyright' ),
            Field::make( 'text', 'signup_shortcode', 'Signup Shortcode' ),
            Field::make( 'complex', 'shares_links', 'Share Links' )
                ->add_fields( array(
                    Field::make( 'set', 'social_links', 'Social Links' )
                        ->add_options( array(
                            'instagram' => 'Instagram',
                            'twitter' => 'Twitter'
                        ) ),
                    Field::make( 'text', 'social_url', 'URL' )
                )),
            Field::make( 'text', 'privacy_message', 'Privacy/Terms Message' ),
            Field::make( 'complex', 'site_credits', 'Site Credits' )
                ->add_fields( array(
                    Field::make( 'rich_text', 'site_credit', 'Site Credit' )
                ))
        ));
}

function attach_page_fields() {
    Container::make( 'post_meta', 'Hero' )
        ->where( 'post_type', '=', 'page' )
        ->set_context( 'carbon_fields_after_title' )
        // ->add_tab( 'Hero', array(
        ->add_fields(array(
            Field::make( 'image', 'cover_art', 'Cover Art' )
                ->set_value_type( 'url' ),
            Field::make( 'text', 'cover_art_subheader', 'Cover Art Subheader' ),
            Field::make( 'text', 'main_title', 'Main Title' ),
            Field::make( 'image', 'title_image', 'Title Image' )
                ->set_value_type( 'url' ),
            Field::make( 'rich_text', 'hero_copy', 'Hero Copy' ),
            Field::make( 'image', 'secondary_image', 'Secondary Image' )
                ->set_value_type( 'url' ),
            Field::make( 'complex', 'listen_links', 'Listen Links' )
                ->add_fields( array(
                    Field::make( 'image', 'icon', 'Icon' ),
                    Field::make( 'text', 'listen_url', 'URL' )
                ))
                ));
    
    Container::make( 'post_meta', 'Video' )
        ->where( 'post_type', '=', 'page' )
        ->set_context( 'carbon_fields_after_title' )
        ->add_fields( array(
            Field::make( 'text', 'video_title', 'Video Title' ),
            Field::make( 'textarea', 'video_embed', 'Video Embed' )
        ));
    
    Container::make( 'post_meta', 'Contact Us' )
        ->where( 'post_type', '=', 'page' )
        ->set_context( 'carbon_fields_after_title' )
        ->add_fields( array(
            Field::make( 'text', 'contact_title', 'Contact Title' ),
            Field::make( 'text', 'contact_shortcode', 'Contact Shortcode' )
        ));
}

function attach_track_fields() {
    Container::make( 'post_meta', 'Track Information' )
        ->where( 'post_type', '=', 'track' )
        ->set_context( 'carbon_fields_after_title' )
        ->add_fields( array(
            Field::make( 'text', 'track_artist', 'Track Artist' ),
            Field::make( 'text', 'track_duration', 'Track Duration' ),
            Field::make( 'text', 'track_number', 'Track Number' ),
            Field::make( 'complex', 'track_credits', 'Track Credits' )
                ->add_fields( array(
                    Field::make( 'text', 'artist_name', 'Artist Name' ),
                    Field::make( 'text', 'artist_instrument', 'Artist Instrument' )
                )),
            Field::make( 'select', 'add_preview', 'Add Preview?' )
                ->add_options( array(
                    'no' => 'No',
                    'yes' => 'Yes'
                )),
            Field::make( 'file', 'the_track', 'MP3 File' )
                ->set_type('audio')
                ->set_conditional_logic( array(
                    'field' => 'add_preview',
                    'value' => 'yes'
                ))
                ->set_conditional_logic( array(
                    'relation' => 'AND', // Optional, defaults to "AND"
                    array(
                        'field' => 'add_preview',
                        'value' => 'yes', // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
                        'compare' => '=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
                    )
                ) ),
        ));
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}
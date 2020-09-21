<?php
add_filter( 'wp_nav_menu_items', 'add_to_nav', 10, 2 );

function add_to_nav( $items, $args )
{
	if( get_field('add_to_main_nav', 'options') ) {
		$items .= '<li class="menu-item"><a href="">'.get_field('nav_label', 'options').'</a></li>';
	}
	return $items;
}
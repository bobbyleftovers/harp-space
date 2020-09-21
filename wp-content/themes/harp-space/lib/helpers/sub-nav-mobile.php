<?php
    add_filter('nav_menu_item_args', function ($args, $item, $depth) {
        if (!$args->add_arrows) return $args;
        if ($args->walker->has_children) {
            if( empty($args->original_link_after) ) {
                $args->original_link_after = $args->link_after;
            }
            $args->link_after = get_module('svg', array(
                'icon' => 'icon-angle-down',
                'class' => 'icon-angle-down submenu-icon'
            ));
        } else {
            $args->link_after = '';
        }
        return $args;
    }, 10, 3);

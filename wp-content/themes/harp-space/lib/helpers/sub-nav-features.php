<?php
    class Sub_Nav_Features extends Walker_Nav_Menu {
        private $sub_nav_features;
        public $style;

        public function __construct($style) {
            $this->style = $style;
            $this->get_sub_nav_features();
        }

        function get_sub_nav_features() {
            // $sub_nav_features = get_field( 'sub_nav_features', 'option' );
            $this->sub_nav_features = array();

            // if (!empty($sub_nav_features) && is_array($sub_nav_features)) {
            //     foreach ( $sub_nav_features as $menu ) {
            //         if ( empty( $menu['menu_item_class'] ) ) {
            //             continue;
            //         }

            //         $this->sub_nav_features[ $menu['menu_item_class'] ] = $menu;
            //     }
            // }
        }

        function get_features( $classes ) {
            foreach ( $this->sub_nav_features as $class => $features ) {
                if ( in_array( $class, $classes ) ) {
                    return $features;
                }
            }

            return false;
        }

        function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {

            // Check each element to see if class name matches theme option class value
            foreach ( $this->sub_nav_features as $class => $features ) {
                if ( in_array( $class, $element->classes ) ) {

                    // Add default class
                    $menu_item_class = 'menu-item-has-children';

                    // Only add features to desktop sub nav
                    if ($this->style == 'desktop') {

                        // Add class
                        $menu_item_class .= ' menu-item-has-features';

                        // Pass current features up
                        $features = $this->get_features( $element->classes );
                        $this->current_features = empty($features) ?: get_module( 'sub-nav-features', array( 'features' => $features ) );
                    }
                    $element->classes[] = $menu_item_class;
                }
            }

            parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
        }

        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);

            // See if this level had features and add to output
            $features = empty($this->current_features) ? '' : $this->current_features;
            if ($features) {
                $output .= "\n$indent<div class=\"sub-menu\" aria-hidden=\"true\"><ul class=\"sub-menu-items\">\n";
            } else {
                $output .= "\n$indent<ul class=\"sub-menu sub-menu-items\" aria-hidden=\"true\">\n";
            }
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat( $t, $depth );

            // See if this level had features and add to output
            $features = empty($this->current_features) ? '' : $this->current_features;
            if ($features) {
                $output .= "$indent</ul>$features</div>{$n}";
            } else {
                $output .= "$indent$features</ul>{$n}";
            }

            // Reset features
            $this->current_features = null;
        }
    }
    // if( get_field('add_to_main_nav', 'options') ) {
    //     $output .= '<li class="menu-item"><a href="">'.get_field('nav_label', 'options').'</a></li>';
    // }
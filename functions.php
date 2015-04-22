<?php

add_action( 'wp_enqueue_scripts', 'twentyfifteen_parent_theme_enqueue_styles' );

function twentyfifteen_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'twentyfifteen-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( '-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('twentyfifteen-style')
    );

}

function multibox_microdata_list_render($arr, $item_prop = '') {
    if (empty($item_prop)) {
        $list_item = '<li>';
    }
    else {
        $list_item = '<li itemprop="' . $item_prop . '">';
    }
    foreach ( $arr as $key => $value ) {
        $serialized = maybe_unserialize( $value );
        foreach ( $serialized as $key ) {
            $output = $list_item;
            foreach ( $key as $field => $value ) {
                $output .= $value;
                $output .= ' ';
            }
            $output .= '</li>';
            echo $output;
        }

    }
}
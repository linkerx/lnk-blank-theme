<?php

/**
 * Soporte para Imagen Destacada
 * (Necesario para que aparezca en el formulario de alta de Post)
 */
add_theme_support( 'post-thumbnails' );

/**
 * Soporte para Menús
 * (Necesario para poder crear menús)
 */
function lnk_register_main_menu() {
    register_nav_menu('site-menu-location','Site Menu Location');
}
add_action( 'init', 'lnk_register_main_menu' );

/**
 * Agrega taxonomia a imagenes para armar albumes
 */
function lnk_attachment_album()
{
    $labels_album = array(
        'name' => "Albums",
        'singular_name' => "album",
    );
    $args_album = array(
        'hierarchical' => true,
        'labels' => $labels_album,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug'=>'album'),
    );
    register_taxonomy('album','attachment',$args_album);
}
add_action( 'init', 'lnk_attachment_album');

/**
 * Agrega sidebars para widgets 
 */
register_sidebar( array(
	'name' => __( 'Inicio Buscar' ),
	'id' => 'buscar-sidebar',
	'description' => __( 'Inicio Buscar' ),
	'before_widget' => "<div class='widget buscar-widget'>",
	'after_widget' => "</div>",
	'before_title' => "<h2>",
	'after_title' => "</h2>"
));

register_sidebar( array(
	'name' => __( 'Cartelera' ),
	'id' => 'cartelera-sidebar',
	'description' => __( 'Cartelera' ),
	'before_widget' => "<div class='widget cartelera-widget'>",
	'after_widget' => "</div>",
	'before_title' => "<h2>",
	'after_title' => "</h2>"
));

register_sidebar( array(
	'name' => __( 'Enlaces' ),
	'id' => 'enlaces-sidebar',
	'description' => __( 'Enlaces' ),
	'before_widget' => "<div class='widget enlaces-widget'>",
	'after_widget' => "</div>",
	'before_title' => "<h2>",
	'after_title' => "</h2>"
));

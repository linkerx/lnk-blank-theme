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

/**
 * Agrego menues de menus y widgets a editor
 */
function hide_menu() {
    if (!current_user_can('administrator')) {
        remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
        remove_submenu_page( 'themes.php', 'customize.php' ); // hide the customizer submenu
   }
}

add_action('admin_head', 'hide_menu');


/**
 * Elimino soporte de comentarios
 */

add_action( 'admin_menu', 'my_remove_admin_menus' );
function my_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
add_action('init', 'remove_comment_support', 100);
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

/**
 * Elimino menú de herramientas
 */
add_action( 'admin_menu', 'lnk_remove_menu_herramientas' );
function lnk_remove_menu_herramientas() {
	if (!current_user_can('administrator')) {
		remove_menu_page( 'tools.php' );
	}
}

/**
 * Para multisite muestro los sitios del usuario alfabeticamente
 */
add_filter('get_blogs_of_user','sort_my_sites');
function sort_my_sites($blogs) {
        $f = create_function('$a,$b','return strcasecmp($a->blogname,$b->blogname);');
        uasort($blogs, $f);
        return $blogs;
}
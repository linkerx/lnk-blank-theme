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
    register_nav_menu('main-menu-location','Main Menu Location');
}
add_action( 'init', 'lnk_register_main_menu' );

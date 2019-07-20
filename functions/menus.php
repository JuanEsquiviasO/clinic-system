<?php
/*
* Functions for Menus
*/
add_theme_support( 'nav-menus' );
register_nav_menus(
	array (
		'menu_lateral_principal' => __('Menu Principal'),
	)
);

function action_nav_class( $clases ) {
	if ( in_array( 'current_page_item', $clases ) ) {
		$clases[] = 'active';
	}
	return $clases;
}

add_action('nav_menu_css_class', '$action_nav_class');

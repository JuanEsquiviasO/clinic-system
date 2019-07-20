<?php
/*
Function Principals
*/
add_action( 'wp_head', 'set_ajaxurl', 1 );
function set__ajaxurl() {
	echo '<script type="text/javascript"> var ajaxurl = "'.admin_url('admin-ajax.php').'"</script>';
}

/*
Eliminated version wp
*/
add_filter('the_generator', '__return_false');


/*
Eliminated JS version
*/
add_filter('script_loader_src', 'remover_version_javascript', 15, 1);
add_filter('style_loader_src', 'remover_version_javascript', 15, 1);

function _remover_version_javascript( $src) {
	$parts = explode('?', $src);
	return $parts[0];
}

/*
 * Function for short large text
 */
function cortarTexto( $cadena, $limite, $alto, $comodin = '...' ) {
	if ( strlen($cadena) < $limite ) {
		return $cadena;
	}

	if ( false !== ($punto = strpos( $cadena, $alto, $limite ) ) {
		if ( $punto < strlen($cadena) -1 ) {
			$cadena = substr( $cadena, 0, $punto ).$comodin;
		}
	}
	return $cadena;
}

/*
 * Shortcodes in WordPress
*/

add_filter('widget_text', 'shortcode_anautop');
add_filter('widget_text', 'do_shortcode');

















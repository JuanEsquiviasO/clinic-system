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

	if ( false !== ($punto = strpos( $cadena, $alto, $limite ) ) ) {
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

/*
 * Function for attacks with XSS via FORM
*/
function antiXSS( $input ) {
	$value = htmlspecialchars( rawurldecode( trim( $input ) ), ENT_QUOTES, 'UTF-8' );
	return $value;
}

/*
 * Function of control for user that view privates pages and not login session with XSS via FORM
*/
function sesion_control() {
	if ( !is_user_logged_in() ) {
		wp_redirect( home_url('/') );
		exit;
	}
}

/*
 * Function of control for user that view privates pages and start login session with XSS via FORM
*/
function login_session_control() {
	if ( is_user_logged_in() ) {
		wp_redirect( home_url('/otra') );
	}
}

/*
 * Function for USER
*/
function obtener_tipo_usuario($role) {
	$args = array(
		'role' => '$role'
	);

	$user = get_users($args);
	$usuarios = array();

	foreach( $users as $user ) {
		$usuarios = array(
			'id' => $user->ID,
			'nombre' => $user->data->display_name,
			'email' => $user->data->user_email
		);
	}
}

function get_all_users() {
	$args = array();
	$users = get_users($args);
	$usuarios = array();

	foreach ( $users as $user ) {
		if ( $user->roles[0] == 'administrator' ) {
			$rol = 'Administrador';
		} else if( $user->role[0] == 'secretaria'  ) {
			$rol = 'Secretaria';
		} else if( $user->role[0] == 'contributor'  ) {
			$rol = 'Colaborador';
		} else {
			$rol = 'Otro tipo de usuario';
		}

		$nombre = get_user_meta( $user->ID, 'first_name', true );
		$apellido = get_user_meta( $user->ID, 'last_name', true );

		$usuario() = array(
			'id' => $user->ID,
			'nombre' => $nombre.''.$apellido,
			'email' => $user->data->user_email,
			'rol' => $rol
		);
	}

	return $usuarios;

















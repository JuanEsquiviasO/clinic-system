<?php

/*
unction Principals
*/
add_action( 'wp_head', 'set_ajaxurl', 1 );
function set_ajaxurl() {
	echo '<script type="text/javascript"> var ajaxurl = "'.admin_url('admin-ajax.php').'"</script>';
}


/*
liminated version wp
*/
add_filter('the_generator', '__return_false');



/*
liminated JS version
*/
add_filter('script_loader_src', '_remover_version_javascript', 15, 1);
add_filter('style_loader_src', '_remover_version_javascript', 15, 1);

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
		}
		else if( $user->role[0] == 'secretaria' ) {
			$rol = 'Secretaria';
		}
		else if( $user->role[0] == 'contributor' ) {
			$rol = 'Colaborador';
		}
		else {
			$rol = 'Otro tipo de usuario';
		}

		$nombre = get_user_meta( $user->ID, 'first_name', true );
		$apellido = get_user_meta( $user->ID, 'last_name', true );

		$usuario[] = array(
					'id' => $user->ID,
					'nombre' => $nombre.' '.$apellido,
					'email' => $user->data->user_email,
					'rol' => $rol
				);
	}

	return $usuarios;
}

function get_count_users() {
	$users = get_all_users();
	return count($users);
}


/* Patients */
function get_pacientes( $limit = -1 ) {
	$args = array(
			'post_type' => 'pacientes',
			'post_status' => 'publish',
			'posts_per_page' => $limit
		);

	$query = new WP_Query( $args );
	$pacientes = array();
	if ( $query->have_posts() ) {
		while( $query->have_posts() ) {
			$query->the_post();
			global $post;

			$nombre = get_post_meta( $post->ID, 'nombres', true );
			$apellidos = get_post_meta( $post->ID, 'apellidos', true );
			$dni = get_post_meta( $post->ID, 'documento de identidad ', true );
			$fechanac = get_post_meta( $post->ID, 'fecha de nacimiento', true );
			$direccion = get_post_meta( $post->ID, 'direccion', true );
			$telefono = get_post_meta( $post->ID, 'telefono', true );
			$fotografia = get_post_meta( $post->ID, 'fotografias', true );
			$foto = ( is_numeric($fotografia) && $fotografia > 0 ) ? wp_get_attachment_url($fotografia) : '';
			$otros = get_post_meta( $post->ID, 'otros datos', true );
			$fecha = get_the_date( 'd/m/y', $post->ID );
			$estatus = wp_get_post_terms( $post->ID, 'estatus', array('fields' => 'all') );
			$referencia = wp_get_post_terms( $post->ID, 'referencias', array('fields' => 'all') );

			$pacientes[] = array(
							'ID' => $post->ID,
							'nombre' => $nombre,
							'apellidos' => $apellidos,
							'dni' => $dni,
							'cumpleanos' => $fechanac,
							'direcion' => $direccion,
							'telefono' => $telefono,
							'foto' => $foto,
							'fecha' => $fecha,
							'estatus' => $estatus,
							'referencia' => $referencia
						);
		}
		wp_reset_postdata();
		wp_reset_query();
	}

	return $pacientes;
}

function get_count_pacientes( ) {
	$pacientes = get_pacientes();
	return count($pacientes);
}


/******* CONSULTAS *******/

/** Get consultas of the pacientes  **/
function get_consultas( $limit = -1 ) {
	$args = array(
			'post_type' => 'consultas',
			'post_status' => 'publish',
			'posts_per_page' => $limit
		);

	$query = new WP_Query($args);
	$consultas = array();

	if( $query->have_posts() ) {
		while( $query->have_posts ) {
			$query->the_post();
			global $post;

			$paciente = get_post_meta($post->ID, 'paciente', true);
			$consulta = get_post_meta($post->ID, 'consulta', true);
			$fecha = get_the_date('d/m/Y', $post->ID);
			$archivo1 = get_post_meta($post->ID, 'archivo_extra_1', true);
			$archivo2 = get_post_meta($post->ID, 'archivo_extra_2', true);
			$archivo3 = get_post_meta($post->ID, 'archivo_extra_3', true);
			$archivo4 = get_post_meta($post->ID, 'archivo_extra_4', true);
			$archivo5 = get_post_meta($post->ID, 'consult_extra_5', true);
			$files = array();

			if( is_numeric($archivo1) && $archivo1 > 0 ) {
				$files[] = wp_get_attachment_url($archivo1);
			}

			if( is_numeric($archivo2) && $archivo2> 0 ) {
				$files[] = wp_get_attachment_url($archivo2);
			}

			if( is_numeric($archivo3) && $archivo3 > 0 ) {
				$files[] = wp_get_attachment_url($archivo3);
			}

			if( is_numeric($archivo4) && $archivo4 > 0 ) {
				$files[] = wp_get_attachment_url($archivo4);
			}

			if( is_numeric($archivo5) && $archivo5 > 0 ) {
				$files[] = wp_get_attachment_url($archivo5);
			}

			$consultas[] = array(
				'ID' => $post->ID,
				'pacientes' => get_the_title($paciente),
				'consulta' => $consulta,
				'archivos' => $files,
				'fecha' => $fecha
			);
		}
		wp_reset_postdata();
		wp_reset_query();
	}
	return $consultas;
}

/**  Get the quantity of consultas ready **/
function get_count_consultas( ) {
	$consultas = get_consultas();
	return count($consultas);
}


function get_recurrencia_consultas() {
	$args = array(
		'post_type' => 'consultas',
		'post_status' => 'publish',
		'posts_per_page' => -1
	);

	if ( $query->have_posts() ) {
		while( $query->have_posts() ) {
			$query->the_post();
			global $post;

			$paciente = get_post_meta($post->ID, 'paciente', true);
			$consultas[$paciente][] = $post->ID;
		}
		wp_reset_postdata();
		wp_reset_query();
	}

	$tipo = array();

	foreach ($consultas as $consulta ) {
		for( $i = 0; $i < count($consulta); $i++ ) {
			if( count($consulta) > 1 ) {
				$tipo['recurrente'] [] = $consulta[$i];
			} else {
				$tipo['norecurrente'] [] = $consulta[$i];
			}
		}
	}

	if ( !isset($tipo['norecurrente']) ) {
		$tipo['norrecurrente'] = array();
	}
	if ( !isset($tipo['recurrente']) ) {
		$tipo['recurrente'] = array();
	}
	return $tipo;
}















<?php
/**
 * Template Name: Pagina d inicio de sesion
**/

if ( isset($_POST['wp-submit']) ) {
	$creds = array();
	$creds['user_login'] = stripslashes( trim( S_POST['user_name'] ) );
	$creds['user_password'] = stripslashes( trim( S_POST['user_pass'] ) );
	$creds['remember'] = true;
	$redirectto = esc_url_raw( $_POST['redirect_to'] );
	$secure_cookie = null;

	$user = wp_signon($creds, $secure_cookie);

	if ( !is_wp_error($user) ) {
		wp_set_current_user( $user->ID, $_POST['user_name'] );
		wp_set_auth_cookie( $user->ID, true, false );
		do_action( 'wp_login', $_POST['user_name'] );
		do_action( 'set_current_user' );

		echo '<script>window.location.href = "'.$redirect_to.'"</script>';
	} else {
		if ( $user->errors ) {
			echo '<script>window.location.href = "'.$home_url('/?edu').'"</script>';
		} else {
			echo '<script>window.location.href = "'.$home_url('/?etd').'"</script>';
		}
	}
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="<?php language_attributes(); ?>">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Favicon icon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>assets/images/favicon.png">
	<title>
		<?php
			wp_title('|', true, 'right');
			bloginfo('name');
		?>
	<title/>
	<!-- Custom CSS -->
	<link href="<?php echo get_template_directory_uri(); ?>/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/basictable.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/jquery.dataTables.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/richtext.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/printer.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	@media (min-width: 768px){
		#main-wrapper[data-layout="vertical"][data-sidebartype="mini-sidebar"] .topbar .top-navbar .navbar-header .navbar-brand .logo {display: block;}
		.topbar .top-navbar .navbar-header .navbar-brand {display: flex;}
	}
	</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="preloader">
		<div class="lds-ripple">
			<div class="lds-pos"></div>
			<div class="lds-pos"></div>
		</div>
	</div>

	<div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
		<header class="topbar" data-navbarbg="skin6">
			<nav class="navbar top-navbar navbar-expand-md navbar-light">
				<div class="navbar-header" data-logobg="skin5" style="width: 100%;">
					<!-- ============================================================== -->
					<!-- Logo -->
					<!-- ============================================================== -->
					<div class="navbar-brand">
						<a href="index.html" class="logo">
							<!-- Logo icon -->
							<b class="logo-icon">
								<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
								<!-- Dark Logo icon -->
								<img src="?php echo get_template_directory_uri(); ?>/assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
								<!-- Light Logo icon -->
								<img src="?php echo get_template_directory_uri(); ?>/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
							</b>
							<!--End Logo icon -->
							<!-- Logo text -->
							<span class="logo-text">
								<!-- dark Logo text -->
								<img src="?php echo get_template_directory_uri(); ?>/assets/images/logo-text.png" alt="homepage" class="dark-logo" />
								<!-- Light Logo text -->
								<img src="?php echo get_template_directory_uri(); ?>/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
							</span>
						</a>
					</div>
					<!-- ============================================================== -->
					<!-- End Logo -->
					<!-- ============================================================== -->
				</div>
				<!-- ============================================================== -->
				<!-- End Logo -->
				<!-- ============================================================== -->
			</nav>
		</header>

		<div class="page-wrapper" style="margin: 0;">
			<div class="container-fluid">
				<div class="row">
					<?php
					if( have_posts() ) {
						while( have_posts() ) {
							the_post();
							the_content();
						}
					}
					?>
				</div>
			</div>
		</div>

		<footer class="footer text-center">
			Todos los derechos reservados. Desarrollado por
			<a href="http://laeliteweb.com">La Élite Web</a>.
		</footer>
	</div>

	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap tether Core JavaScript -->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- slimscrollbar scrollbar JavaScript -->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/extra-libs/sparkline/sparkline.js"></script>
	<!--Wave Effects -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/waves.js"></script>
	<!--Menu sidebar -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/sidebarmenu.js"></script>
	<!--Custom JavaScript -->
	<script src="<?php echo get_template_directory_uri(); ?>/js/custom.min.js"></script>
	<!--This page JavaScript -->
	<!--chartis chart-->
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/chartist/dist/chartist.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/pages/dashboards/dashboard1.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.basictable.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mask.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.richtext.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap3-typeahead.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/init.js"></script>
</body>
</html>

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
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.png">
	<title>
		<?php
			wp_title('|', true, 'right');
			bloginfo('name');
		?>
	</title/>
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
				<div class="navbar-header" data-logobg="skin5">
					<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
						<i class="ti-menu ti-close"></i>
					</a>
					<div class="navbar-brand">
						<a href="index.html" class="logo">
							<b class="logo-icon">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
							</b>
							<span class="logo-text">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-light-text.png" class="light-logo" alt="homepage" />
							</span>
						</a>
					</div>
					<a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent"
							aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<i class="ti-more"></i>
					</a>
				</div>
				<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
					<ul class="navbar-nav float-left mr-auto">

					</ul>
					<ul class="navbar-nav float-right">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/doctor-user.png" alt="user" class="rounded-circle" width="31"></a>
							<div class="dropdown-menu dropdown-menu-right user-dd animated">
								<a class="dropdown-item" href="<?php echo home_url('/perfil/'); ?>"><i class="ti-user m-r-5 m-l-5"></i> Mi perfil</a>
								<a class="dropdown-item" href="<?php echo home_url('/configuracion/'); ?>"><i class="ti-wallet m-r-5 m-l-5"></i> Configuraciones</a>
								<a class="dropdown-item" href="<?php echo wp_logout_url( home_url('/') ); ?>"><i class="ti-direction m-r-5 m-l-5"></i> Salir</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="left-sidebar" data-sidebarbg="skin5">
			<div class="scroll-sidebar">
				<nav class="sidebar-nav">
					<ul id="sidebarnav">
						<li class="sidebar-item">
							<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo home_url('/dashboard/'); ?>" aria-expanded="false">
								<i class="mdi mdi-av-timer"></i>
								<span class="hide-menu">Inicio</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo home_url('/pacientes/'); ?>" aria-expanded="false">
								<i class="mdi mdi-account-network"></i>
								<span class="hide-menu">Pacientes</span>
							</a>
						</li>
							<li class="sidebar-item">
								<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo home_url('/consultas/'); ?>" aria-expanded="false">
									<i class="mdi mdi-arrange-bring-forward"></i>
									<span class="hide-menu">Consultas</span>
								</a>
						</li>
							<li class="sidebar-item">
								<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo home_url('/recetas/'); ?>" aria-expanded="false">
									<i class="mdi mdi-arrange-bring-forward"></i>
									<span class="hide-menu">Recetas</span>
								</a>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo home_url('/usuarios/'); ?>" aria-expanded="false">
								<i class="mdi mdi-face"></i>
								<span class="hide-menu">Usuarios</span>
							</a>
						</li>
						<li class="sidebar-item">
							<a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo home_url('/configuracion/'); ?>" aria-expanded="false">
								<i class="mdi mdi-image-filter-vintage"></i>
								<span class="hide-menu">Configuraciones</span>
							</a>
						</li>
					</ul>
				</nav>
			</div>
		</aside>

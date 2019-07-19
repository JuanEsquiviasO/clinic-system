<?php
	get_header();
?>
<div class="page-wrapper">
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-5 align-self-center">
				<h4 class="page-title"><?php echo get_the_title(); ?></h4>
			</div>
			<div class="col-7 align-self-center">
				<div class="d-flex align-items-center justify-content-end">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo home_url(); ?>">Inicio</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page"><?php echo get_the_title(); ?></li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid">
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
<?php
	get_footer();
?>

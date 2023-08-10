<?php get_header(); ?>
	<?php 
		require(get_template_directory() . '/components/parent/header.php'); 	
	?>
	<div class="pa-widgets pt-5">
		<div class="container">
			<div class="row row-cols-auto">
				<?php 
					if ( is_active_sidebar( 'index' ) ) {
						dynamic_sidebar( 'index');
						}
				?>
			</div>
		</div>
	</div>

<?php get_footer();?>

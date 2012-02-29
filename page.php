<?php get_header(); ?>
	<div id="primary">
	<div id="back-button"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><--</a></div>
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
				
				<!-- Commenting on pages is stupid -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
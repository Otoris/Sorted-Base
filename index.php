<?php
	get_header();
?>
	<div id="articles">
		<?php /* Start the Loop */ ?>
		<?php if (have_posts()) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

		<?php endwhile; else : ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</div>
<?php
	get_footer(); 
?>
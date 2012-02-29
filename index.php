<?php
	get_header();
?>
	<div id="articles">
		<?php /* Start the Loop */ ?>
		<?php if (have_posts()) : ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>
			<div id="divider"></div>
			<div id="divider2"><span class="arrow-left"></span><span class="arrow-right"></span></div>
		<?php endwhile; ?>
			<?php sorted_content_nav( 'nav-below' ); ?>
			
		<?php else : ?>
		
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			
		<?php endif; ?>
	</div>
<?php
	get_footer(); 
?>
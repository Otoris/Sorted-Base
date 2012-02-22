<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/reset.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>
<body>
<header id="site-header">
	<div id="site-banner">
		<?php
		    // Check to see if the header image has been removed
		    $header_image = get_header_image();
		    if ( ! empty( $header_image ) ) :
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		    <?php
		    	// The header image
		    	// Check if this is a post or page, if it has a thumbnail, and if it's a big one
		    	if ( is_singular() &&
		    			has_post_thumbnail( $post->ID ) &&
		    			( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( HEADER_IMAGE_WIDTH, HEADER_IMAGE_WIDTH ) ) ) &&
		    			$image[1] >= HEADER_IMAGE_WIDTH ) :
		    		// Houston, we have a new header image!
		    		echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
		    	else : ?>
		    	<img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
		    <?php endif; // end check for featured image or standard header ?>
		</a>
		<?php endif; // end check for removed header image ?>
	</div>
	<div id="site-title">
		<hgroup>
			<h1>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</h1>
			<h2>
				<?php bloginfo( 'description' ); ?>
			</h2>
		</hgroup>
	</div>
</header>
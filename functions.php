<?php

add_action( 'after_setup_theme', 'sorted_setup' );

if ( ! function_exists( 'sorted_setup' ) ):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * To override sorted_setup() in a child theme, add your own sorted_setup to your child theme's
	 * functions.php file.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To style the visual editor.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, and Post Formats.
	 * @uses register_nav_menus() To add support for navigation menus.
	 * @uses add_custom_background() To add support for a custom background.
	 * @uses add_custom_image_header() To add support for a custom header.
	 * @uses register_default_headers() To register the default custom header images provided with the theme.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Sorted 1.0
	 */
	function sorted_setup() {

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'posted' ) );

		// Add support for a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
		add_theme_support( 'post-thumbnails' );
		
		// The next four constants set how Twenty Eleven supports custom headers.

		// The default header text color
		define( 'HEADER_TEXTCOLOR', '000' );
	
		// By leaving empty, we allow for random image rotation.
		define( 'HEADER_IMAGE', '' );
	
		// The height and width of your custom header.
		// Add a filter to twentyeleven_header_image_width and twentyeleven_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH', apply_filters( 'twentyeleven_header_image_width', 622 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'twentyeleven_header_image_height', 210 ) );
	
		// We'll be using post thumbnails for custom header images on posts and pages.
		// We want them to be the size of the header image that we just defined
		// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );
	
		// Add Twenty Eleven's custom image sizes
		add_image_size( 'large-feature', HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true ); // Used for large feature (header) images
		//add_image_size( 'small-feature', 500, 300 ); // Used for featured posts if a large-feature doesn't exist
		
		// Turn on random header image rotation by default.
		add_theme_support( 'custom-header', array( 'random-default' => true ) );
		
		// Add a way for the custom header to be styled in the admin panel that controls
		// custom headers. See sorted_admin_header_style(), below.
		add_custom_image_header( 'sorted_header_style', 'sorted_admin_header_style', 'sorted_admin_header_image' );
		
		// ... and thus ends the changeable header business.
		
		// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
		register_default_headers( array(
			'common-ground' => array(
				'url' => '%s/images/headers/common-ground.jpg',
				'thumbnail_url' => '%s/images/headers/common-ground-thumbnail.jpg',
				/* translators: header image description */
				'description' => __( 'Common Ground', 'sorted' )
			)
		) );
	}
endif; // sorted_setup

if ( ! function_exists( 'sorted_retrieve_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own sorted_posted_on to override in a child theme
 *
 * @since Sorted 1.0
 */
function sorted_retrieve_meta() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'sorted' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'sorted' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

if ( ! function_exists( 'sorted_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function sorted_header_style() {

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == get_header_textcolor() )
		return;
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == get_header_textcolor() ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo get_header_textcolor(); ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // sorted_header_style

if ( ! function_exists( 'sorted_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sorted_setup().
 *
 * @since Twenty Eleven 1.0
 */
function sorted_admin_header_style() {
?>
	<style type="text/css">
		#site-header {
			display: block;
			max-width: 960px;
			height: 220px;
			width: auto;
			margin-bottom: 8px;
			margin-top: 8px;
		}
		
		#site-banner {
			float: left;
			width: 630px;
			height: 218px;
			border-color:#adadad;
			border-width:1px;
			border-style:solid;
			padding: 0;
			margin-right: 8px;
			background-color:#fff;
		}
		
		#site-title {
			float: left;
			width: 318px;
			height: 218px;
			border-color:#adadad;
			border-width:1px;
			border-style:solid;
			padding: 0;
			background-color:#fff;
		}
		#site-title h1, #site-title a {
			float: right;
			line-height: 50px;
			width: 184px;
			height: 150px;
			font-weight: lighter;
			letter-spacing: 0px;
			font-family:Helvetica,Verdana,Arial,sans-serif;
			font-size: 42px;
			padding: 0;
			margin: 0;
			margin-right: 4px;
			text-align: right;
			color: black;
			text-decoration: none;
		}
		#site-title h2 {
			float: right;
			font-weight: bold;
			font-style: oblique;
			letter-spacing: 0px;
			font-family:Helvetica,Verdana,Arial,sans-serif;
			font-size: 22px;
			margin: 0;
			padding: 0;
			margin-top: 1px;
			margin-right: 9px;
			text-align: right;
			color: black;
		}
	<?php
		// If the user has set a custom color for the text use that
		if ( get_header_textcolor() != HEADER_TEXTCOLOR ) :
	?>
		#site-title a,
		#site-title {
			color: #<?php echo get_header_textcolor(); ?>;
		}
	<?php endif; ?>
	#site-banner img {
		max-width: 622px;
		height: auto;
		width: 100%;
		margin: 4px;
	}
	</style>
<?php
}
endif; // sorted_admin_header_style

if ( ! function_exists( 'sorted_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in sorted_setup().
 *
 * @since Twenty Eleven 1.0
 */
function sorted_admin_header_image() { ?>
	<div id="site-header">
		<?php
		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
		?>
		<div id="site-banner">		
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
			<?php endif; ?>
		</div>
		<div id="site-title">
			<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		</div>
	</div>
<?php }
endif; // sorted_admin_header_image

?>

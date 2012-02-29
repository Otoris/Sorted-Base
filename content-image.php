<div id="image-post">
     <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <header class="entry-header nil-spacing">
         	<div class="meta-title">
         		<ul>
         	    <li>From:</li>
         	    <li>Subject:</li>
         	    <li>Date:</li>
         	    </ul>
         	</div>
 			
         	<div class="meta-entries entry-meta">
         	    <h2 class="entry-meta"><?php the_author(); ?></h2>
 			
         	    <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sorted' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
 			
         	    <h2 class="entry-meta"><?php the_time( __('F j, Y g:i:s A T') ); ?></h2>
         	</div>
         </header>
         <div id="post-divider" class="nil-spacing"><hr class="hr1">
         <ul id="post-controls" class="nil-spacing">
 			<li id="reply-control"><?php if ( comments_open() && ! post_password_required() ) : ?><?php comments_popup_link( __( 'Reply', 'sorted' ) , _x( '1', 'comments number', 'sorted' ), _x( '%', 'comments number', 'sorted' ) ); ?><?php endif; ?></li>
 			<li id="tweet-control"><a href="https://twitter.com/intent/tweet?text=<?php the_title();?>+//+<?php the_permalink(); ?>">Tweet</a></li>
 			<li id="forward-control"><a href="#">Forward</a></li>
 		</ul>
        </div>
	    <?php if ( 'post' == get_post_type() ) : ?>
	    <?php endif; ?>
	
	    <div class="comments-link">
	       
	    </div><!-- .entry-header -->
	
	    <div class="image-content">
	    	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sorted' ) ); ?>
	    </div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- #post-wrap -->

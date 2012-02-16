   <div class="post-wrap">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
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
            <div id="post-divider"><hr class="hr1">
            <ul id="post-controls">
				<li id="reply-control"><?php if ( comments_open() && ! post_password_required() ) : ?><?php comments_popup_link( __( 'Reply', 'sorted' ) , _x( '1', 'comments number', 'sorted' ), _x( '%', 'comments number', 'sorted' ) ); ?><a href="#">Reply</a><?php endif; ?></li>
				<li id="tweet-control"><a href="https://twitter.com/intent/tweet?text=EthanTrawicksBlogTweetTest">Tweet</a></li>
				<li id="forward-control"><a href="#">Forward</a></li>
			</ul>
            </div>
    <?php if ( 'post' == get_post_type() ) : ?>
    <?php endif; ?>

    <div class="comments-link">
        
    </div><!-- .entry-header -->
    <?php if ( is_search() ) : // Only display Excerpts for Search ?>

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>

    <div class="entry-content">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sorted' ) ); ?><?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'sorted' ) . '</span>', 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->
</div>
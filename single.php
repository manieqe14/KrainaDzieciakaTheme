<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
  
get_header(); ?>
  
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
			<div class="kraina-container archive-container">
  
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
  
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<?php if ( is_singular() ) : ?>
					<?php the_title( '<h1 class="single-post-title default-max-width">', '</h1>' ); ?>
				<?php else : ?>
					<?php the_title( sprintf( '<h2 class="single-post-title default-max-width"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php endif; ?>
		
			</header><!-- .entry-header -->

            <div class="post-info-row">
                <div class="post-author">Autor: <a href="<?php echo get_author_posts_url(get_the_author_meta('ID'));?>"><?php the_author(); ?></a></div>
                <div class="post-meta-divider"></div>
                <div class="post-date"><?php the_date(); ?></div>
                <div class="categories">Kategorie: <?php echo get_the_category()[0]->name; ?></div>
                <div class="post-meta-divider"></div>
                <div class="tags">Tagi: <?php
                     foreach(wp_get_post_tags($post->ID) as $tag){
                        echo $tag->name . ', ';
                     }
                ?></div>
            </div>
		
			<div class="entry-content">
				<?php
				the_content();
				?>
            <a href="<?php echo site_url('/blog'); ?>">
                <button class="posts-list-back">Wróć do listy wpisów</button> 
            </a>
			</div><!-- .entry-content -->
			</article>
            
            <div class="post-comments">

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
  
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Kolejny', 'twentyfifteen' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Kolejny post:', 'twentyfifteen' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Poprzedni', 'twentyfifteen' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Poprzedni post:', 'twentyfifteen' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );

            echo '</div>';
  
        // End the loop.
        endwhile;
        ?>

			</div>
        </main><!-- .site-main -->
    </div><!-- .content-area -->
  
<?php get_footer(); ?>

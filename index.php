<?php
/**
 * Index template.
 *
 * @package Neve
 */
$container_class = apply_filters( 'neve_container_class_filter', 'container', 'blog-archive' );

get_header();

?>
	<div class="kraina-container archive-container">
		<div class="row">
			<div class="nv-index-posts blog col">
				<?php
				if ( have_posts() ) {
					/* Start the Loop. */
					echo '<div class="posts-wrapper row">';


					$pagination_type = get_theme_mod( 'neve_pagination_type', 'number' );
					if ( $pagination_type !== 'infinite' ) {
						global $wp_query;

						$posts_on_current_page = $wp_query->post_count;
						$hook_after_post       = -1;

						if ( $posts_on_current_page >= 2 ) {
							$hook_after_post = intval( ceil( $posts_on_current_page / 2 ) );
						}
						$post_index = 1;
					}
					while ( have_posts() ) {
						the_post();
						get_template_part( 'template-parts/content', get_post_type() );

						if ( $pagination_type !== 'infinite' ) {
							if ( $post_index === $hook_after_post && $hook_after_post !== - 1 ) {
							}
							$post_index ++;
						}
					}
					echo '</div>';
					if ( ! is_singular() ) {
						do_action( 'neve_do_pagination', 'blog-archive' );
					}
				} else {
					get_template_part( 'template-parts/content', 'none' );
				}
				?>
				<div class="w-100"></div>
			</div>
		</div>
	</div>
<?php
get_footer();

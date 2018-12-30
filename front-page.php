<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package kirsten
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
			// the query
			$sticky = get_option( 'sticky_posts' );
			$args = array(
			'post_type' => 'post',
			'posts_per_page' => 1,
			'orderby' => 'post__in', 
			'post__in' => $sticky
			);

			$the_query = new WP_Query( $args ); ?>

			<?php if ( $the_query->have_posts() ) : ?>

			  <!-- the loop -->
			  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
							<div class="entry-meta">
			<?php gridpack_posted_on(); ?>
		</div><!-- .entry-meta -->
						</header><!-- .entry-header -->

						<?php
						global $more;
						$more = 0;
						?>
						<div class="entry-content">
								    <?php the_content('Read more...'); ?>
						</div>

						

		<?php edit_post_link( __( 'Edit', 'kirsten' ), '<span class="edit-link">', '</span>' ); ?>
	
				</article>		
					

			  <?php endwhile; ?>
			  <!-- end of the loop -->


			  <?php wp_reset_postdata(); ?>

			<?php else:  ?>
			  <p><?php _e( 'Sorry, no posts matched your criteria.', 'kirsten' ); ?></p>
<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>

	</div><!-- #content -->


<?php get_footer(); ?>

<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage BVS_Eventos
 * @since BVS Eventos 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header>
				<?php if ( defined( 'POLYLANG_VERSION' ) ) : ?>
				<h1 class="event-label"><?php pll_e('Next events'); ?></h1>
				<?php else : ?>
				<h1 class="event-label"><?php _e( 'Next events', 'bvs-events-calendar' ); ?></h1>
				<?php endif; ?>
			</header>

			<?php if ( defined( 'POLYLANG_VERSION' ) ) : ?>
				<?php $home_desc = pll__('Home description'); ?>
				<?php if ( $home_desc ) : ?>
					<p class="home-description"><?php echo $home_desc; ?></p>
				<?php endif; ?>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/event' );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'bvs-events-calendar' ),
				'next_text'          => __( 'Next page', 'bvs-events-calendar' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'bvs-events-calendar' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>

</div><!-- .site-content -->

<?php get_sidebar( 'content-bottom' ); ?>

<div>
	
<?php get_footer(); ?>

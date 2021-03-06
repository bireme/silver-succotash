<?php
/**
 * The template for displaying all single events
 *
 * @package WordPress
 * @subpackage BVS_Eventos
 * @since BVS Eventos 1.0
 */
?>

<?php
    $venue = get_field('venue');
    $location = get_field('location');
    $address = $venue ? $venue : $location['address'];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-event' ); ?>>
	<header class="entry-header">
		<?php the_title( '<span class="event-title">', '</span>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( ! empty( $address ) ) : ?>
			<div class="session-venue">
				<?php echo $address; ?>
			</div>
		<?php endif; ?>

		<?php if ( get_field('start_date') ) : ?>
			<div class="session-date">
				<?php
					$start_date = date("d/m/Y", strtotime(get_field('start_date')));
					$end_date = (get_field('end_date') && get_field('start_date') != get_field('end_date')) ? ' - ' . date("d/m/Y", strtotime(get_field('end_date'))) : '';
					
					echo '<span>' . __( 'Date', 'bvs-events-calendar' ) . ': </span>' . $start_date . $end_date;
				?>
			</div>
		<?php endif; ?>

		<span class="event-details">
			<a href="<?php the_permalink(); ?>"><?php _e('See more details', 'bvs-events-calendar'); ?></a>
		</span>

		<?php if ( has_tag() ) : ?>
            <div class="event-tags">
                <i class="fa fa-tags"></i>
                <?php
                	$tags = wp_get_post_tags($post->ID);
                	$tag_name = wp_list_pluck( $tags, 'name' );
                	echo implode(', ', $tag_name);
                ?> 
              </div>
        <?php endif; ?>

		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bvs-events-calendar' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

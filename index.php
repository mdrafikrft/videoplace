<?php
/**
 * Home.php
 *
 * @package VideoPlace
 * @author  Jacob Martella
 * @version  1.1
 */
?>
<?php get_header(); ?>

	<div id="content">

		<div class="row" id="top-post">
			<?php
				if (esc_attr(get_theme_mod('videoplace-show-sticky-post')) == 1) {
					$top_post_args = array(
						'posts_per_page'      => 1,
						'post__in'            => get_option( 'sticky_posts' )
					);
				} else {
					$top_post_args = array(
						'posts_per_page'      => 1,
						'ignore_sticky_posts' => 1
					);
				}
				$top_post = new WP_Query($top_post_args);
				if ( $top_post->have_posts() ) : while ( $top_post->have_posts() ) : $top_post->the_post(); $do_not_duplicate[] = $post->ID;
			?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="large-8 medium-12 small-12 columns">
						<?php echo hybrid_media_grabber(); ?>
					</div>
					<div class="details large-4 medium-12 small-12 columns">
						<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-details clearfix">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
							<h4 class="post-detail"><?php echo __( 'Posted by ', 'videoplace' ); the_author_posts_link(); echo __( ' on ', 'videoplace' ); the_date( get_option( 'date_format' ) ); ?></h4>
						</div>
						<?php the_excerpt(); ?>
						<a href="<?php the_permalink(); ?>" class="button white"><?php _e( 'View Video Info', 'videoplace' ); ?></a>
					</div>
				</article>
			<?php endwhile; endif; wp_reset_query(); ?>
		</div>

		<div id="inner-content" class="row home-posts-section">

			<div class="home-posts large-8 medium-12 small-12 columns">
				<?php
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$home_args = array(
						'posts_per_page' 	=> get_option( 'post_per_page' ),
						'paged' 			=> $paged,
						'post__not_in' 		=> $do_not_duplicate
					);
					$home_posts = new WP_Query($home_args);
					if ($home_posts->have_posts()) : while ($home_posts->have_posts()) : $home_posts->the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'video-post' ); ?>>
						<h5 class="post-category"><?php $cats = get_the_category(); echo $cats[ 0 ]->name; ?></h5>
						<?php echo hybrid_media_grabber(); ?>
						<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="post-details clearfix">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?>
							<h4 class="post-detail"><?php echo __( 'Posted by ', 'videoplace' ); the_author_posts_link(); echo __( ' on ', 'videoplace' ); the_date( get_option( 'date_format' ) ); ?></h4>
						</div>
						<a href="<?php the_permalink(); ?>" class="button white"><?php _e( 'View Video Info', 'videoplace' ); ?></a>
					</article>
				<?php endwhile; videoplace_page_navi(); endif; wp_reset_query(); ?>
			</div>

			<?php get_sidebar(); ?>

		</div> <!-- end #inner-content -->

	</div> <!-- end #content -->

<?php get_footer(); ?>
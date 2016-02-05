<?php get_header(); ?>

	<div id="wrap" class="container clearfix">

		<section id="content" class="primary" role="main">

			<div class="type-page">

				<h2 class="page-title"><?php esc_html_e( '404: Page not found', 'momentous-lite' ); ?></h2>

				<div class="entry">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search or one of the links below?', 'momentous-lite' ); ?></p>

					<?php get_search_form(); ?>

					<?php // Set Widget arguments
					$args = array(
						'before_widget' => '<section class="404-widget">',
						'after_widget' => '</section>',
						'before_title' => '<h3>',
						'after_title' => '</h3>',
					); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts', '', $args ); ?>

					<?php the_widget( 'WP_Widget_Archives', 'dropdown=1', $args ); ?>

					<?php the_widget( 'WP_Widget_Categories', 'dropdown=1', $args ); ?>

					<?php the_widget( 'WP_Widget_Tag_Cloud', '', $args ); ?>

				</div>

			</div>

		</section>

		<?php get_sidebar(); ?>

	</div>

<?php get_footer(); ?>

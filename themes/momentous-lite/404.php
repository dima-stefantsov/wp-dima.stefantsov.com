<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">

			<div class="type-page">
			
				<h2 class="page-title"><?php _e('404: Page not found', 'momentous-lite'); ?></h2>
				
				<div class="entry">
					<p><?php _e('It looks like nothing was found at this location. Maybe try a search or one of the links below?', 'momentous-lite'); ?></p>
					
					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php the_widget( 'WP_Widget_Archives', 'dropdown=1' ); ?>
					
					<?php the_widget( 'WP_Widget_Categories', 'dropdown=1' ); ?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>
					
				</div>
				
			</div>

		</section>
		
		<?php get_sidebar(); ?>
		
	</div>

<?php get_footer(); ?>
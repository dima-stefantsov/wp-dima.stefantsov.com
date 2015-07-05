<?php get_header(); ?>

<?php // Get Theme Options from Database
	$theme_options = momentous_theme_options();
?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php if (have_posts()) : ?>
			<h2 id="search-title" class="archive-title">
				<?php printf( 'Найдено по запросу: %s', '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
		
			<div id="post-wrapper" class="clearfix">
		 
			<?php while (have_posts()) : the_post();
		
				get_template_part( 'content', $theme_options['post_layout'] );
		
			endwhile; ?>
			
			</div>
			
			<?php // Display Pagination	
			momentous_display_pagination();

		else : ?>

			<h2 id="search-title" class="archive-title">
				<?php printf( 'Искали по запросу: %s', '<span>' . get_search_query() . '</span>' ); ?>
			</h2>
			
			<div class="post type-page">
				<div class="entry">
	  				<p>И ничего не смогли найти =(</p>
					<p>
						Попробуйте ввести другой запрос или перейти на <a href="/">главную страницу</a>.
						Ещё ссылки в меню справа → очень хорошо помогают.
					</p>
				</div>
			</div>

			<?php endif; ?>
			
		</section>
		
		<?php get_sidebar(); ?>
	</div>
	
<?php get_footer(); ?>	
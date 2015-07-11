<?php get_header(); ?>

	<div id="wrap" class="container clearfix">
		
		<section id="content" class="primary" role="main">
		
		<?php if (have_posts()) : while (have_posts()) : the_post();
		
			get_template_part( 'content', 'single' );

			endwhile;
		
		endif; ?>

		<?php if(is_active_sidebar('sidebar-below-single')){dynamic_sidebar('sidebar-below-single');} ?>			

		<?php comments_template(); ?>
		
		</section>
		
		<?php get_sidebar(); ?>

	</div>
	
<?php get_footer(); ?>	
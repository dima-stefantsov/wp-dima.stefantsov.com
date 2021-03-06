<?php
/***
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard. 
 *
 */


// Add Theme Info page to admin menu
add_action('admin_menu', 'momentous_add_theme_info_page');
function momentous_add_theme_info_page() {
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
	add_theme_page( 
		sprintf( esc_html__( 'Welcome to %1$s %2$s', 'momentous-lite' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), 
		esc_html__( 'Theme Info', 'momentous-lite' ), 
		'edit_theme_options', 
		'momentous', 
		'momentous_display_theme_info_page'
	);
	
}


// Display Theme Info page
function momentous_display_theme_info_page() { 
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
?>
			
	<div class="wrap theme-info-wrap">

		<h1><?php printf( esc_html__( 'Welcome to %1$s %2$s', 'momentous-lite' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo $theme->get( 'Description' ); ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php esc_html_e( 'Theme Links', 'momentous-lite' ); ?>:</strong>
				<a href="<?php echo esc_url( __( 'https://themezee.com/themes/momentous/', 'momentous-lite' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=momentous&utm_content=theme-page' ); ?>" target="_blank"><?php esc_html_e( 'Theme Page', 'momentous-lite' ); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php esc_html_e( 'Changelog', 'momentous-lite' ); ?></a>
				<a href="<?php echo esc_url( 'http://preview.themezee.com/momentous/?utm_source=theme-info&utm_medium=textlink&utm_campaign=momentous&utm_content=demo' ); ?>" target="_blank"><?php esc_html_e( 'Theme Demo', 'momentous-lite' ); ?></a>
				<a href="<?php echo esc_url( __( 'https://themezee.com/docs/momentous-documentation/', 'momentous-lite' ) . '?utm_source=theme-info&utm_medium=textlink&utm_campaign=momentous&utm_content=documentation' ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'momentous-lite' ); ?></a>
				<a href="<?php echo esc_url( 'http://wordpress.org/support/view/theme-reviews/momentous-lite?filter=5' ); ?>" target="_blank"><?php esc_html_e( 'Rate this theme', 'momentous-lite' ); ?></a>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">
		
			<h3><?php printf( esc_html__( 'Getting Started with %s', 'momentous-lite' ), $theme->get( 'Name' ) ); ?></h3>
			
			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
						
					<div class="section">
						<h4><?php esc_html_e( 'Theme Documentation', 'momentous-lite' ); ?></h4>
						
						<p class="about">
							<?php esc_html_e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'momentous-lite' ); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( __( 'https://themezee.com/docs/momentous-documentation/', 'momentous-lite' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=momentous&utm_content=documentation' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'View %s Documentation', 'momentous-lite' ), 'Momentous' ); ?>
							</a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php esc_html_e( 'Theme Options', 'momentous-lite' ); ?></h4>
						
						<p class="about">
							<?php printf( esc_html__( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'momentous-lite' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary">
								<?php esc_html_e( 'Customize Theme', 'momentous-lite' ); ?>
							</a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php esc_html_e( 'Pro Version', 'momentous-lite' ); ?></h4>
						
						<p class="about">
							<?php printf( esc_html__( 'Purchase the Pro Version of %s to get additional features and advanced customization options.', 'momentous-lite' ), 'Momentous'); ?>
						</p>
						<p>
							<a href="<?php echo esc_url( __( 'https://themezee.com/addons/momentous-pro/', 'momentous-lite' ) . '?utm_source=theme-info&utm_medium=button&utm_campaign=momentous&utm_content=pro-version' ); ?>" target="_blank" class="button button-secondary">
								<?php printf( esc_html__( 'Learn more about %s Pro', 'momentous-lite' ), 'Momentous'); ?>
							</a>
						</p>
					</div>

				</div>
				
				<div class="column column-half clearfix">
					
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
					
				</div>
				
			</div>
			
		</div>
		
		<hr>
		
		<div id="theme-author">
			
			<p><?php printf( esc_html__( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'momentous-lite' ), 
				$theme->get( 'Name' ),
				'<a target="_blank" href="' . __( 'https://themezee.com/', 'momentous-lite' ) . '?utm_source=theme-info&utm_medium=footer&utm_campaign=momentous" title="ThemeZee">ThemeZee</a>',
				'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/momentous-lite?filter=5" title="Momentous Lite Review">' . esc_html__( 'rate it', 'momentous-lite' ) . '</a>'); ?>
			</p>
		
		</div>
	
	</div>

<?php
}


// Add CSS for Theme Info Panel
add_action('admin_enqueue_scripts', 'momentous_theme_info_page_css');
function momentous_theme_info_page_css( $hook ) { 

	// Load styles and scripts only on theme info page
	if ( 'appearance_page_momentous' != $hook ) {
		return;
	}
	
	// Embed theme info css style
	wp_enqueue_style('momentous-lite-theme-info-css', get_template_directory_uri() .'/css/theme-info.css');

}
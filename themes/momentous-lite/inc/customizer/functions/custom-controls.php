<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER CONTROLS FUNCTIONS ==========================*/

if ( class_exists( 'WP_Customize_Control' ) ) :
	
	// Title Control
    class Momentous_Customize_Header_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>
			
			<?php
        }
    }
	
	// Description Control
	class Momentous_Customize_Description_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>
			
			<?php
        }
    }
	
	// Upgrade Control
	class Momentous_Customize_Upgrade_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<div class="upgrade-pro-version">
			
				<span class="customize-control-title"><?php esc_html_e( 'Pro Version', 'momentous-lite' ); ?></span>
				
				<span class="textfield">
					<?php printf( esc_html__( 'Purchase the Pro Version of %s to get additional features and advanced customization options.', 'momentous-lite' ), 'Anderson'); ?>
				</span>
				
				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/addons/momentous-pro/', 'momentous-lite' ) ); ?>?utm_source=customizer&utm_medium=button&utm_campaign=momentous&utm_content=pro-version" target="_blank" class="button button-secondary">
						<?php printf( esc_html__( 'Learn more about %s Pro', 'momentous-lite' ), 'Momentous'); ?>
					</a>
				</p>
				
			</div>
			
			<div class="upgrade-plugins">
			
				<span class="customize-control-title"><?php esc_html_e( 'ThemeZee Plugins', 'momentous-lite' ); ?></span>
				
				<span class="textfield">
					<?php esc_html_e( 'Extend the functionality of your WordPress website with our customized plugins.', 'momentous-lite' ); ?>
				</span>
				
				<p>
					<a href="<?php echo esc_url( __( 'https://themezee.com/plugins/', 'momentous-lite' ) ); ?>?utm_source=customizer&utm_medium=button&utm_campaign=momentous&utm_content=plugins" target="_blank" class="button button-secondary">
						<?php esc_html_e( 'Browse Plugins', 'momentous-lite' ); ?>
					</a>
					<a href="<?php echo admin_url( 'plugin-install.php?tab=search&type=author&s=themezee' ); ?>" class="button button-primary">
						<?php esc_html_e( 'Install now', 'momentous-lite' ); ?>
					</a>
				</p>
			
			</div>
			
			<?php
        }
    }
	
endif;
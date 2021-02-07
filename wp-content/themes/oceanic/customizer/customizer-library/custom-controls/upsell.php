<?php
/**
 * Customize for upsell button, extend the WP customizer
 *
 * @package 	Customizer_Library
 * @author		Devin Price, The Theme Foundry
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return NULL;
}

class Customizer_Library_Upsell extends WP_Customize_Control {

	/**
	 * Render the control's content.
	 *
	 * Allows the content to be overriden without having to rewrite the wrapper.
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	public function render_content() {
		?>
		<div class="freelancelot-upsell">
			<div class="freelancelot-upsell-title"><?php echo esc_html( $this->label ); ?></div>
			<a href="<?php echo esc_url( 'http://app.sellwire.net/p/R7' ); ?>" target="_blank" class="freelancelot-upsell-btn"><?php echo __( 'Buy Oceanic Premium', 'oceanic' ); ?></a>
            <div class="freelancelot-upsell-desc"><a href="<?php echo admin_url( 'themes.php?page=premium_upgrade' ); ?>" target="_blank"><?php echo __( 'See the premium features', 'oceanic' ); ?></a></div>
		</div>
		<?php
	}

}
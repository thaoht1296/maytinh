<?php

namespace Rtwpvg\Controllers;

use Rtwpvg\Helpers\Options;


class SettingsAPI {

	private $setting_id = 'rtwpvg';
	private $defaults = array();
	private $sections = array();

	public function __construct() {
		$this->sections = Options::get_settings_sections();
		add_action( 'init', array( $this, 'set_defaults' ), 8 );
		add_filter( 'plugin_action_links_' . rtwpvg()->basename(), array(
			$this,
			'plugin_action_links'
		) );
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_tab' ), 50 );
		add_action( 'woocommerce_settings_tabs_' . $this->setting_id, array( $this, 'settings_tab' ) );
		add_action( 'woocommerce_update_options_' . $this->setting_id, array( $this, 'update_settings' ) );
		add_action( 'woocommerce_admin_field_' . $this->setting_id, array( $this, 'global_settings' ) );
	}

	public function set_defaults() {
		foreach ( $this->sections as $section ) {
			foreach ( $section['fields'] as $field ) {
				$field['default'] = isset( $field['default'] ) ? $field['default'] : null;
				$this->set_default( $field['id'], $field['type'], $field['default'] );
			}
		}
	}

	private function set_default( $key, $type, $value ) {
		$this->defaults[ $key ] = array( 'id' => $key, 'type' => $type, 'value' => $value );
	}

	private function get_default( $key ) {
		return isset( $this->defaults[ $key ] ) ? $this->defaults[ $key ] : null;
	}

	public function get_defaults() {
		return $this->defaults;
	}

	public function plugin_action_links( $links ) {
		$new_links = array(
			'<a href="' . admin_url( '/admin.php?page=wc-settings&tab=' . $this->setting_id ) . '">' . __( "Settings", 'woo-product-variation-gallery' ) . '</a>',
			'<a target="_blank" href="' . esc_url( 'https://radiustheme.com/demo/wordpress/wooplugins/product/woocommerce-variation-images-gallery/' ) . '">' . esc_html__( "Demo", 'woo-product-variation-gallery' ) . '</a>',
			'<a target="_blank" href="' . esc_url( 'https://www.radiustheme.com/how-to-use-woocommerce-variation-images-gallery/' ) . '">' . esc_html__( "Documentation", 'woo-product-variation-gallery' ) . '</a>',
			'<a style="color: #39b54a;font-weight: 700;" target="_blank" href="' . esc_url( 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery/' ) . '">' . esc_html__( "Get Pro", 'woo-product-variation-gallery' ) . '</a>'
		);

		return array_merge( $links, $new_links );
	}

	public function add_settings_tab( $settings_tabs ) {
		$settings_tabs[ $this->setting_id ] = __( 'Variation Gallery', 'woo-product-variation-gallery' );

		return $settings_tabs;
	}

	public function settings_tab() {
		woocommerce_admin_fields( $this->get_settings() );
	}

	public function update_settings() {
		woocommerce_update_options( $this->get_settings() );
	}

	public function get_settings() {
		$settings = array(
			array(
				'name' => __( 'WooCommerce Variation images gallery', 'woo-product-variation-gallery' ),
				'type' => 'title',
				'desc' => '',
				'id'   => 'rtwpvg_settings_section'
			),
			array(
				'type' => $this->setting_id,
				'id'   => $this->setting_id
			),
			'section_end' => array(
				'type' => 'sectionend',
				'id'   => 'rtwpvg_settings_section'
			)
		);

		return apply_filters( 'rtwpvg_get_settings', $settings );
	}

	public function options_tabs() {
		?>
        <nav class="nav-tab-wrapper wp-clearfix">
			<?php foreach ( $this->sections as $tabs ): ?>
                <a data-target="<?php echo $tabs['id'] ?>"
                   class="rtwpvg-setting-nav-tab nav-tab <?php echo $this->get_options_tab_css_classes( $tabs ) ?> "
                   href="#<?php echo $tabs['id'] ?>"><?php echo $tabs['title'] ?></a>
			<?php endforeach; ?>
        </nav>
		<?php
	}

	function global_settings() {
		?>
        <div id="rtwpvg-settings-container">
            <div id="rtwpvg-settings-wrapper">
				<?php $this->options_tabs(); ?>
                <div id="rtwpvg-settings-tabs">
					<?php foreach ( $this->sections as $section ):
						if ( ! isset( $section['active'] ) ) {
							$section['active'] = false;
						}
						$is_active = ( $this->get_last_active_tab() == $section['id'] );
						?>
                        <div id="<?php echo $section['id'] ?>"
                             class="settings-tab rtwpvg-setting-tab"
                             style="<?php echo ! $is_active ? 'display: none' : '' ?>">
                            <div class="section-heading">
                                <h2><?php echo $section['title']; ?></h2>
								<?php echo $this->get_field_description( $section ) ?>
                            </div>
                            <div class="rtwpvg-setting-fields-wrapper"><?php $this->do_settings_fields( $section['fields'] ); ?></div>
                        </div>
					<?php endforeach; ?>
                </div>
				<?php $this->last_tab_input(); ?>
            </div>
            <div class="rtwpvg-doc-wrapper rt-doc-wrapper">
	            <div class="rt-pro-btn-wrap rt-doc-box">
		            <a target="_blank" href="https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery/" class="rt-pro-btn rt-btn">Update Pro To Get More Advantage Features</a>
	            </div>
                <div class="rt-doc-box">
                    <div class="item-header">
                        <div class="item-icon"><span class="dashicons dashicons-media-document"></span></div>
                        <h3 class="item-title">Documentation</h3>
                    </div>
                    <div class="item-content">
                        <p>Get started by spending some time with the documentation.</p>
                        <a target="_blank"
                           href="https://www.radiustheme.com/how-to-use-woocommerce-variation-images-gallery/"
                           class="rt-admin-btn">Documentation</a>
                    </div>
                </div>
                <div class="rt-doc-box">
                    <div class="item-header">
                        <div class="item-icon"><span class="dashicons dashicons-sos"></span></div>
                        <h3 class="item-title">Need Help?</h3>
                    </div>
                    <div class="item-content">
                        <p>Stuck with something? Please create a
                            <a target="_blank" href="https://www.radiustheme.com/contact/">ticket here</a>.
                            For emergency case join our <a target="_blank" href="https://www.radiustheme.com/">live
                                chat</a>.</p>
                        <a target="_blank" href="https://www.radiustheme.com/contact/" class="rt-admin-btn">Get Support</a>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

	private function do_settings_fields( $fields ) {
		foreach ( (array) $fields as $field ) {
			$custom_attributes = $this->array2html_attr( isset( $field['attributes'] ) ? $field['attributes'] : array() );
			$wrapper_id        = ! empty( $field['id'] ) ? esc_attr( $field['id'] ) . '-wrapper' : '';
			$dependency        = ! empty( $field['require'] ) ? $this->build_dependency( $field['require'] ) : '';
			$html              = '';
			if ( $field['type'] == 'title' ) {
				$html .= sprintf( '<div class="rtwpvg-item-title">%s%s</div>',
					isset( $field['title'] ) && $field['title'] ? "<h3>{$field['title']}</h3>" : '',
					$this->get_field_description( $field )
				);
			} else if ( $field['type'] == 'feature' ) {
				$html .= sprintf( '<div class="rtwpvg-item-feature">%s%s%s</div>',
					isset( $field['title'] ) && $field['title'] ? "<h3>{$field['title']}</h3>" : '',
					$this->get_field_description( $field ),
					$this->field_callback( $field )
				);
			} else {
				$html .= sprintf( '<div class="rtwpvg-field-label">%s</div>',
					isset( $field['label_for'] ) && ! empty( $field['label_for'] ) ?
						sprintf( '<label for="%s">%s</label>', esc_attr( $field['label_for'] ), $field['title'] ) :
						$field['title']
				);

				$html .= sprintf( '<div class="rtwpvg-field">%s</div>', $this->field_callback( $field ) );
			}
			echo sprintf( '<div id="%s" class="rtwpvg-setting-field" %s %s>%s</div>', $wrapper_id, $custom_attributes, $dependency, $html );
		}
	}

	private function last_tab_input() {
		printf( '<input type="hidden" id="_last_active_tab" name="%s[_last_active_tab]" value="%s">', $this->setting_id, $this->get_last_active_tab() );
	}

	public function field_callback( $field ) {

		switch ( $field['type'] ) {
			case 'radio':
				$field_html = $this->radio_field_callback( $field );
				break;

			case 'checkbox':
				$field_html = $this->checkbox_field_callback( $field );
				break;

			case 'select':
				$field_html = $this->select_field_callback( $field );
				break;

			case 'number':
				$field_html = $this->number_field_callback( $field );
				break;

			case 'color':
				$field_html = $this->color_field_callback( $field );
				break;

			case 'post_select':
				$field_html = $this->post_select_field_callback( $field );
				break;

			case 'feature':
				$field_html = $this->feature_field_callback( $field );
				break;

			case 'title':
				$field_html = $this->title_field_callback( $field );
				break;

			default:
				$field_html = $this->text_field_callback( $field );
				break;
		}
		ob_start();
		echo $field_html;
		do_action( 'rtwpvg_settings_field_callback', $field );

		return ob_get_clean();
	}

	public function checkbox_field_callback( $args ) {

		$value = (bool) $this->get_option( $args['id'] );

		$attrs = isset( $args['attrs'] ) ? $this->make_implode_html_attributes( $args['attrs'] ) : '';

		return sprintf( '<fieldset><label><input %1$s type="checkbox" id="%2$s-field" name="%4$s[%2$s]" value="%3$s" %5$s/> %6$s</label></fieldset>',
			$attrs,
			$args['id'],
			true,
			$this->setting_id,
			checked( $value, true, false ),
			isset( $args['desc'] ) ? esc_attr( $args['desc'] ) : null
		);

	}

	public function radio_field_callback( $args ) {
		$options = apply_filters( "rtwpvg_settings_{$args[ 'id' ]}_radio_options", $args['options'] );
		$value   = esc_attr( $this->get_option( $args['id'] ) );

		$attrs = isset( $args['attrs'] ) ? $this->make_implode_html_attributes( $args['attrs'] ) : '';


		$html = '<fieldset>';
		$html .= implode( '<br />', array_map( function ( $key, $option ) use ( $attrs, $args, $value ) {
			return sprintf( '<label><input %1$s type="radio" id="%2$s-field" name="%4$s[%2$s]" value="%3$s" %5$s/> %6$s</label>', $attrs, $args['id'], $key, $this->setting_id, checked( $value, $key, false ), $option );
		}, array_keys( $options ), $options ) );
		$html .= $this->get_field_description( $args );
		$html .= '</fieldset>';

		return $html;
	}

	public function select_field_callback( $args ) {
		$options = apply_filters( "rtwpvg_settings_{$args[ 'id' ]}_select_options", $args['options'] );
		$value   = esc_attr( $this->get_option( $args['id'] ) );
		$options = array_map( function ( $key, $option ) use ( $value ) {
			return "<option value='{$key}'" . selected( $key, $value, false ) . ">{$option}</option>";
		}, array_keys( $options ), $options );
		$size    = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

		$attrs = isset( $args['attrs'] ) ? $this->make_implode_html_attributes( $args['attrs'] ) : '';

		$html = sprintf( '<select %5$s class="%1$s-text" id="%2$s-field" name="%4$s[%2$s]">%3$s</select>', $size, $args['id'], implode( '', $options ), $this->setting_id, $attrs );
		$html .= $this->get_field_description( $args );

		return $html;
	}

	public function get_field_description( $args ) {
		if ( isset( $args['desc'] ) && ! empty( $args['desc'] ) ) {
			$desc = sprintf( '<p class="description">%s</p>', $args['desc'] );
		} else {
			$desc = '';
		}

		return $desc;
	}

	public function post_select_field_callback( $args ) {

		$options = apply_filters( "rtwpvg_settings_{$args[ 'id' ]}_post_select_options", $args['options'] );

		$value = esc_attr( $this->get_option( $args['id'] ) );

		$options = array_map( function ( $option ) use ( $value ) {
			return "<option value='{$option->ID}'" . selected( $option->ID, $value, false ) . ">$option->post_title</option>";
		}, $options );

		$size = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';
		$html = sprintf( '<select class="%1$s-text" id="%2$s-field" name="%4$s[%2$s]">%3$s</select>', $size, $args['id'], implode( '', $options ), $this->setting_id );
		$html .= $this->get_field_description( $args );
		return $html;
	}

	public function text_field_callback( $args ) {
		$value = esc_attr( $this->get_option( $args['id'] ) );
		$size  = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'regular';

		$attrs = isset( $args['attrs'] ) ? $this->make_implode_html_attributes( $args['attrs'] ) : '';

		$html = sprintf( '<input %5$s type="text" class="%1$s-text" id="%2$s-field" name="%4$s[%2$s]" value="%3$s"/>', $size, $args['id'], $value, $this->setting_id, $attrs );
		$html .= $this->get_field_description( $args );

		return $html;
	}

	public function feature_field_callback( $args ) {

		$is_html = isset( $args['html'] );

		if ( $is_html ) {
			$html = $args['html'];
		} else {
			$image = esc_url( $args['screen_shot'] );
			$link  = esc_url( $args['product_link'] );


			$width = isset( $args['width'] ) ? $args['width'] : '70%';

			$html = sprintf( '<a target="_blank" href="%s"><img style="width: %s" src="%s" /></a>', $link, $width, $image );
			$html .= $this->get_field_description( $args );
		}


		return $html;
	}

	public function color_field_callback( $args ) {
		$value = esc_attr( $this->get_option( $args['id'] ) );
		$alpha = isset( $args['alpha'] ) && $args['alpha'] === true ? ' data-alpha="true"' : '';
		$html  = sprintf( '<input type="text" %1$s class="rtwpvg-color-picker" id="%2$s-field" name="%4$s[%2$s]" value="%3$s"  data-default-color="%3$s" />', $alpha, $args['id'], $value, $this->setting_id );
		$html  .= $this->get_field_description( $args );

		return $html;
	}

	public function number_field_callback( $args ) {
		$value  = esc_attr( $this->get_option( $args['id'] ) );
		$size   = isset( $args['size'] ) && ! is_null( $args['size'] ) ? $args['size'] : 'small';
		$min    = isset( $args['min'] ) && ! is_null( $args['min'] ) ? 'min="' . $args['min'] . '"' : '';
		$max    = isset( $args['max'] ) && ! is_null( $args['max'] ) ? 'max="' . $args['max'] . '"' : '';
		$step   = isset( $args['step'] ) && ! is_null( $args['step'] ) ? 'step="' . $args['step'] . '"' : '';
		$suffix = isset( $args['suffix'] ) && ! is_null( $args['suffix'] ) ? ' <span>' . $args['suffix'] . '</span>' : '';
		$attrs  = isset( $args['attrs'] ) ? $this->make_implode_html_attributes( $args['attrs'] ) : '';
		$html   = sprintf( '<input %9$s type="number" class="%1$s-text" id="%2$s-field" name="%4$s[%2$s]" value="%3$s" %5$s %6$s %7$s /> %8$s', $size, $args['id'], $value, $this->setting_id, $min, $max, $step, $suffix, $attrs );
		$html   .= $this->get_field_description( $args );
		return $html;
	}


	/**
	 * @param      $option
	 *
	 * @param null $givenDefault
	 *
	 * @return mixed|void
	 */
	public function get_option( $option, $givenDefault = null ) {
		$default = $this->get_default( $option );
		$options = get_option( $this->setting_id );
		$is_new  = ( ! is_array( $options ) && is_bool( $options ) );
		if ( $is_new ) {
			$value = $default['value'];
		} else {
			$value = isset( $options[ $option ] ) ? $options[ $option ] : '';
			if ( $givenDefault && ! $value ) {
				$value = $givenDefault;
			}
		}

		return apply_filters( 'rtwpvg_get_option', $value, $default, $option, $options, $is_new );
	}

	private function get_options_tab_css_classes( $tabs ) {
		$classes   = array();
		$classes[] = ( $this->get_last_active_tab() == $tabs['id'] ) ? 'nav-tab-active' : '';

		return implode( ' ', array_unique( apply_filters( 'rtwpvg_get_options_tab_css_classes', $classes ) ) );
	}

	private function get_last_active_tab() {
		$last_tab = trim( $this->get_option( '_last_active_tab' ) );
		if ( isset( $_GET['tab'] ) && ! empty( $_GET['tab'] ) && $this->setting_id == $_GET['tab'] && isset( $_GET['section'] ) && ! empty( $_GET['section'] ) ) {
			$last_tab = trim( $_GET['section'] );
		}
		$default_tab = 'general';
		foreach ( $this->sections as $tabs ) {
			if ( isset( $tabs['active'] ) && $tabs['active'] ) {
				$default_tab = $tabs['id'];
				break;
			}
		}

		return ! empty( $last_tab ) ? $last_tab : $default_tab;
	}

	public function update_option( $key, $value ) {
		$options         = get_option( $this->setting_id );
		$options[ $key ] = $value;
		update_option( $this->setting_id, $options );
	}

	public function sanitize_callback( $options ) {
		foreach ( $this->get_defaults() as $opt ) {
			if ( $opt['type'] === 'checkbox' && ! isset( $options[ $opt['id'] ] ) ) {
				$options[ $opt['id'] ] = 0;
			}
		}

		return $options;
	}

	public function make_implode_html_attributes(
		$raw_attributes, $except = array(
		'type',
		'id',
		'name',
		'value'
	)
	) {
		$attributes = array();
		foreach ( $raw_attributes as $name => $value ) {
			if ( in_array( $name, $except ) ) {
				continue;
			}
			$attributes[] = esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
		}

		return implode( ' ', $attributes );
	}

	public function array2html_attr( $attributes, $do_not_add = array() ) {

		$attributes = wp_parse_args( $attributes, array() );
		if ( ! empty( $do_not_add ) and is_array( $do_not_add ) ) {
			foreach ( $do_not_add as $att_name ) {
				unset( $attributes[ $att_name ] );
			}
		}
		$attributes_array = array();
		foreach ( $attributes as $key => $value ) {
			if ( is_bool( $attributes[ $key ] ) and $attributes[ $key ] === true ) {
				return $attributes[ $key ] ? $key : '';
			} elseif ( is_bool( $attributes[ $key ] ) and $attributes[ $key ] === false ) {
				$attributes_array[] = '';
			} else {
				$attributes_array[] = $key . '="' . $value . '"';
			}
		}

		return implode( ' ', $attributes_array );
	}

}


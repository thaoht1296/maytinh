<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Customizer Library Demo
 */

if ( ! function_exists( 'customizer_library_oceanic_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_oceanic_build_styles() {

    // Main Color
    $color = 'oceanic-main-color';
    $colormod = get_theme_mod( $color, customizer_library_get_default( $color ) );
    
    $bgcolormod = get_theme_mod( $color, customizer_library_get_default( $color ) );
    $bghardcolormod = get_theme_mod( $color, customizer_library_get_default( $color ) );
    $bgbordercolormod = get_theme_mod( $color, customizer_library_get_default( $color ) );

    if ( $colormod !== customizer_library_get_default( $color ) ) {

        $sancolor = esc_html( $colormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'a,
                .site-title,
                .search-btn,
                .error-404.not-found .page-header .page-title span,
                .search-button .fa-search,
                .widget-area .widget a,
                .site-top-bar-left-text em,
                .site-footer-bottom-bar a,
                .header-menu-button,
                .color-text'
            ),
            'declarations' => array(
                'color' => $sancolor
            )
        ) );
    }
    
	if ( $bgbordercolormod !== customizer_library_get_default( $color ) ) {

        $sancolor = esc_html( $bgbordercolormod );
    	    
    	Customizer_Library_Styles()->add( array(
    		'selectors' => array(
	    		'div.wpforms-container form.wpforms-form input[type="text"]:focus,
				div.wpforms-container form.wpforms-form input[type="email"]:focus,
				div.wpforms-container form.wpforms-form input[type="tel"]:focus,
				div.wpforms-container form.wpforms-form input[type="number"]:focus,
				div.wpforms-container form.wpforms-form input[type="url"]:focus,
				div.wpforms-container form.wpforms-form input[type="password"]:focus,
				div.wpforms-container form.wpforms-form input[type="search"]:focus,
				div.wpforms-container form.wpforms-form select:focus,
				div.wpforms-container form.wpforms-form textarea:focus,
				input[type="text"]:focus,
				input[type="email"]:focus,
				input[type="tel"]:focus,
	    		input[type="number"]:focus,
				input[type="url"]:focus,
				input[type="password"]:focus,
				input[type="search"]:focus,
				textarea:focus,
				select:focus'
    		),
    		'declarations' => array(
    			'border-color' => $sancolor
    		)
    	) );
    }
    
    if ( $bgcolormod !== customizer_library_get_default( $color ) ) {

        $bgsancolor = esc_html( $bgcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '#comments .form-submit #submit,
                .search-block .search-submit,
                .no-results-btn,
                button,
                input[type="button"],
                input[type="reset"],
                input[type="submit"],
                .woocommerce ul.products li.product a.add_to_cart_button,
                .woocommerce-page ul.products li.product a.add_to_cart_button,
                .woocommerce button.button.alt,
                .woocommerce-page button.button.alt,
                .woocommerce input.button.alt:hover,
                .woocommerce-page #content input.button.alt:hover,
                .woocommerce .cart-collaterals .shipping_calculator .button,
                .woocommerce-page .cart-collaterals .shipping_calculator .button,
                .woocommerce a.button,
                .woocommerce-page a.button,
                .woocommerce input.button,
                .woocommerce-page #content input.button,
                .woocommerce-page input.button,
                .woocommerce #review_form #respond .form-submit input,
                .woocommerce-page #review_form #respond .form-submit input,
                .main-navigation a:hover,
                .main-navigation li.current-menu-item > a,
                .main-navigation li.current_page_item > a,
                .main-navigation li.current-menu-parent > a,
                .main-navigation li.current_page_parent > a,
                .main-navigation li.current-menu-ancestor > a,
                .main-navigation li.current_page_ancestor > a,
                .main-navigation button,
                .wpcf7-submit'
            ),
            'declarations' => array(
                'background' => 'inherit',
                'background-color' => $bgsancolor
            )
        ) );
    }
    
    if ( $bghardcolormod !== customizer_library_get_default( $color ) ) {

        $bghardsancolor = esc_html( $bghardcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '.header-cart-checkout.cart-has-items .fa-shopping-cart'
            ),
            'declarations' => array(
                'background-color' => $bghardsancolor . ' !important'
            )
        ) );
        
		Customizer_Library_Styles()->add( array(
        	'selectors' => array(
				'::-moz-selection'
			),
			'declarations' => array(
				'background-color' => $sancolor
			)
		) );

		Customizer_Library_Styles()->add( array(
        	'selectors' => array(
				'::selection'
			),
			'declarations' => array(
				'background-color' => $sancolor
			)
		) );        
        
    }
    
    if ( $bgbordercolormod !== customizer_library_get_default( $color ) ) {

        $bgbordersancolor = esc_html( $bgbordercolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
				'.site-content .rpwe-block li'
            ),
            'declarations' => array(
				'border-color' => $bgbordersancolor
            )
        ) );
    }

    if ( $bgbordercolormod !== customizer_library_get_default( $color ) ) {

        $bgbordersancolor = esc_html( $bgbordercolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
				'.woocommerce .woocommerce-message'
            ),
            'declarations' => array(
                'border-top-color' => $bgbordersancolor
            )
        ) );
    }	
	
    // Main Color Hover
    $colorh = 'oceanic-main-color-hover';
    $colorhmod = get_theme_mod( $colorh, customizer_library_get_default( $colorh ) );
    
    $bgcolorhmod = get_theme_mod( $colorh, customizer_library_get_default( $colorh ) );

    if ( $colorhmod !== customizer_library_get_default( $colorh ) ) {

        $sancolorh = esc_html( $colorhmod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'a:hover,
                .widget-area .widget a:hover,
                .site-footer-widgets .widget a:hover,
                .site-footer-bottom-bar a:hover,
                .search-btn:hover,
                .search-button .fa-search:hover,
                .site-header .site-top-bar-left a:hover,
                .site-header .site-top-bar-right a:hover,
                .site-header .site-header-right a:hover,
                .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
                .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active'
            ),
            'declarations' => array(
                'color' => $sancolorh
            )
        ) );
    }
    
    if ( $bgcolorhmod !== customizer_library_get_default( $colorh ) ) {

        $bgsancolorh = esc_html( $bgcolorhmod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                '.main-navigation button:hover,
                #comments .form-submit #submit:hover,
                .search-block .search-submit:hover,
                .no-results-btn:hover,
                button:hover,
                input[type="button"]:hover,
                input[type="reset"]:hover,
                input[type="submit"]:hover,
                .site-header .site-top-bar-right a:hover .header-cart-checkout .fa,
				.site-header .site-header-right a:hover .header-cart-checkout .fa,
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt,
                .woocommerce .cart-collaterals .shipping_calculator .button,
                .woocommerce-page .cart-collaterals .shipping_calculator .button,
                .woocommerce a.button:hover,
                .woocommerce-page a.button:hover,
                .woocommerce input.button:hover,
                .woocommerce-page #content input.button:hover,
                .woocommerce-page input.button:hover,
                .woocommerce ul.products li.product a.add_to_cart_button:hover,
                .woocommerce-page ul.products li.product a.add_to_cart_button:hover,
                .woocommerce button.button.alt:hover,
                .woocommerce-page button.button.alt:hover,
                .woocommerce #review_form #respond .form-submit input:hover,
                .woocommerce-page #review_form #respond .form-submit input:hover,
                .wpcf7-submit:hover'
            ),
            'declarations' => array(
                'background' => 'inherit',
                'background-color' => $bgsancolorh
            )
        ) );
    }


    // Body Font
    $font = 'oceanic-body-font';
    $fontmod = get_theme_mod( $font, customizer_library_get_default( $font ) );
    $fontstack = customizer_library_get_font_stack( $fontmod );
    
    $fontcolor = 'oceanic-body-font-color';
    $fontcolormod = get_theme_mod( $fontcolor, customizer_library_get_default( $fontcolor ) );

    if ( $fontmod != customizer_library_get_default( $font ) ) {

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
            	'body,
                .site-footer-widgets .widget a,
                .site-footer-bottom-bar a'
            ),
            'declarations' => array(
                'font-family' => $fontstack
            )
        ) );

    }
    
    if ( $fontcolormod !== customizer_library_get_default( $fontcolor ) ) {

        $sanfontcolor = esc_html( $fontcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'body,
                .site-header .site-top-bar-left a,
                .site-header .site-top-bar-right a,
                .site-header .site-header-right a,
                .woocommerce ul.products li.product .price,
				.woocommerce #content ul.products li.product span.price,
				.woocommerce-page #content ul.products li.product span.price,
				.woocommerce #content div.product p.price,
				.woocommerce-page #content div.product p.price,
				.woocommerce-page div.product p.price,
				.woocommerce #content div.product span.price,
				.woocommerce div.product span.price,
				.woocommerce-page #content div.product span.price,
				.woocommerce-page div.product span.price,
                .site-footer-widgets .widget a'
            ),
            'declarations' => array(
                'color' => $sanfontcolor
            )
        ) );
    }

    if ( $fontcolormod !== customizer_library_get_default( $fontcolor ) ) {
    
    	$sanfontcolor = esc_html( $fontcolormod );
    
    	Customizer_Library_Styles()->add( array(
	    	'selectors' => array(
    			'.header-cart-checkout .fa'
    		),
    		'declarations' => array(
    			'background-color' => $sanfontcolor
    		)
    	) );
    }
    
    // Heading Font
    $hfont = 'oceanic-heading-font';
    $hfontmod = get_theme_mod( $hfont, customizer_library_get_default( $hfont ) );
    $hfontstack = customizer_library_get_font_stack( $hfontmod );
    
    $hfontcolor = 'oceanic-heading-font-color';
    $hfontcolormod = get_theme_mod( $hfontcolor, customizer_library_get_default( $hfontcolor ) );

    if ( $hfontmod != customizer_library_get_default( $hfont ) ) {

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
                .site-title,
                .site-description,
                .woocommerce table.cart th,
                .woocommerce-page #content table.cart th,
                .woocommerce-page table.cart th,
                .woocommerce input.button.alt,
                .woocommerce-page #content input.button.alt,
                .woocommerce table.cart input,
                .woocommerce-page #content table.cart input,
                .woocommerce-page table.cart input,
                button,
                input[type="button"],
                input[type="reset"],
                input[type="submit"]'
            ),
            'declarations' => array(
                'font-family' => $hfontstack
            )
        ) );

    }
    
    if ( $hfontcolormod !== customizer_library_get_default( $hfontcolor ) ) {

        $sanhfontcolor = esc_html( $hfontcolormod );

        Customizer_Library_Styles()->add( array(
            'selectors' => array(
                'h1, h2, h3, h4, h5, h6,
                h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
                .site-description'
            ),
            'declarations' => array(
                'color' => $sanhfontcolor
            )
        ) );
    }


}
endif;

add_action( 'customizer_library_styles', 'customizer_library_oceanic_build_styles' );

if ( ! function_exists( 'customizer_library_oceanic_styles' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function customizer_library_oceanic_styles() {

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"freelancelot-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'customizer_library_oceanic_styles', 11 );
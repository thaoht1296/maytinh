/**
 * Oceanic Customizer Custom Functionality
 *
 */
( function( $ ) {
    
    $( window ).load( function() {
        
        var the_select_value = $( '#customize-control-oceanic-slider-type select' ).val();
        oceanic_customizer_slider_check( the_select_value );
        
        $( '#customize-control-oceanic-slider-type select' ).on( 'change', function() {
            var select_value = $( this ).val();
            oceanic_customizer_slider_check( select_value );
        } );
        
        function oceanic_customizer_slider_check( select_value ) {
            if ( select_value == 'oceanic-slider-default' ) {
                $( '#customize-control-oceanic-meta-slider-shortcode' ).hide();
                $( '#customize-control-oceanic-slider-cats' ).show();
                $( '#customize-control-oceanic-slider-transition-speed' ).show();
                $( '#customize-control-oceanic-upsell-six' ).show();
                $( '#customize-control-oceanic-upsell-seven' ).show();
                
            } else if ( select_value == 'oceanic-meta-slider' ) {
                $( '#customize-control-oceanic-slider-cats' ).hide();
                $( '#customize-control-oceanic-slider-transition-speed' ).hide();
                $( '#customize-control-oceanic-upsell-six' ).hide();
                $( '#customize-control-oceanic-upsell-seven' ).hide();
                $( '#customize-control-oceanic-meta-slider-shortcode' ).show();
                
            } else {
                $( '#customize-control-oceanic-slider-cats' ).hide();
                $( '#customize-control-oceanic-slider-transition-speed' ).hide();
                $( '#customize-control-oceanic-upsell-six' ).hide();
                $( '#customize-control-oceanic-upsell-seven' ).hide();
                $( '#customize-control-oceanic-meta-slider-shortcode' ).hide();
                
            }
        }
        
    } );
    
} )( jQuery );
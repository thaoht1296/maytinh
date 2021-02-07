<?php
/**
 * Slider js Template
 *
 * This template can be overridden by copying it to yourtheme/woo-product-variation-gallery/template-slider.php
 *
 */

defined('ABSPATH') || exit;
?>
<script type="text/html" id="tmpl-rtwpvg-slider-template">
    <div class="rtwpvg-gallery-image">
        <div>
            <div class="rtwpvg-single-image-container">
                <# if( data.srcset ){ #>
                <img class="{{data.class}}" width="{{data.src_w}}" height="{{data.src_h}}" src="{{data.src}}"
                     alt="{{data.alt}}" title="{{data.title}}" data-caption="{{data.caption}}"
                     data-src="{{data.full_src}}" data-large_image="{{data.full_src}}"
                     data-large_image_width="{{data.full_src_w}}" data-large_image_height="{{data.full_src_h}}"
                     srcset="{{data.srcset}}" sizes="{{data.sizes}}" {{data.extra_params}}/>
                <# }else{ #>
                <img class="{{data.class}}" width="{{data.src_w}}" height="{{data.src_h}}" src="{{data.src}}"
                     alt="{{data.alt}}" title="{{data.title}}" data-caption="{{data.caption}}"
                     data-src="{{data.full_src}}" data-large_image="{{data.full_src}}"
                     data-large_image_width="{{data.full_src_w}}" data-large_image_height="{{data.full_src_h}}"
                     sizes="{{data.sizes}}" {{data.extra_params}}/>
                <# } #>
            </div>
        </div>
    </div>
</script>
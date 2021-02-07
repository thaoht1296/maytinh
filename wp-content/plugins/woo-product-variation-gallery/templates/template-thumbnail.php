<?php
/**
 * Admin Thumbnail js
 *
 * This template can be overridden by copying it to
 * yourtheme/woo-product-variation-gallery/template-thumbnail.php
 *
 */

defined('ABSPATH') || exit;
?>
<script type="text/html" id="tmpl-rtwpvg-thumbnail-template">
    <div class="rtwpvg-thumbnail-image">
        <div>
            <img width="{{data.gallery_thumbnail_src_w}}" height="{{data.gallery_thumbnail_src_h}}"
                 src="{{data.gallery_thumbnail_src}}" alt="{{data.alt}}" title="{{data.title}}"
                 data-caption="{{data.caption}}" data-src="{{data.full_src}}"/>
        </div>
    </div>
</script>
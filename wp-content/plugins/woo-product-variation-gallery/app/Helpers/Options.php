<?php

namespace Rtwpvg\Helpers;

class Options
{

    public static function get_settings_sections() {
        $fields = array(
            'general'         => array(
                'id'     => 'general',
                'title'  => esc_html__('General', 'woo-product-variation-gallery'),
                'desc'   => esc_html__('Simple change some visual styles', 'woo-product-variation-gallery'),
                'fields' => apply_filters('rtwpvg_general_setting_fields', array(
                    array(
                        'title'    => esc_html__('Thumbnails Items per row', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_thumbnails_columns', 4)),
                        'desc_tip' => esc_html__('Product Thumbnails Item Image', 'woo-product-variation-gallery'),
                        'desc'     => sprintf(esc_html__('Product Thumbnails Item Image. Default value is: %d. Limit: 2-8.', 'woo-product-variation-gallery'), absint(apply_filters('rtwpvg_thumbnails_columns', 4))),
                        'id'       => 'thumbnails_columns',
                        'min'      => 2,
                        'max'      => 8,
                        'step'     => 1,
                    ),
                    array(
                        'title'    => esc_html__('Thumbnails Gap', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_thumbnails_gap', 5)),
                        'desc_tip' => esc_html__('Product Thumbnails Gap In Pixel', 'woo-product-variation-gallery'),
                        'desc'     => sprintf(esc_html__('Product Thumbnails Gap In Pixel. Default value is: %d. Limit: 0-20.', 'woo-product-variation-gallery'), apply_filters('rtwpvg_thumbnails_gap', 0)),
                        'id'       => 'thumbnails_gap',
                        'min'      => 0,
                        'max'      => 20,
                        'step'     => 1,
                        'suffix'   => 'px'
                    ),
                    array(
                        'title'    => esc_html__('Gallery Width (Large Device)', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_gallery_width', 45)),
                        'desc_tip' => esc_html__('Slider gallery width in % for large devices.', 'woo-product-variation-gallery'),
                        'desc'     => 'For large devices.<br>' . sprintf(__('Slider Gallery Width in %%. Default value is: %d. Limit: 10-100.', 'woo-product-variation-gallery'), absint(apply_filters('rtwpvg_default_width', 30))),
                        'id'       => 'gallery_width',
                        'min'      => 10,
                        'max'      => 100,
                        'step'     => 1,
                        'suffix'   => '%'
                    ),
                    array(
                        'title'    => esc_html__('Gallery Width (Medium Device)', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_gallery_md_width', 0)),
                        'desc_tip' => esc_html__('Slider gallery width in px for medium devices, small desktop', 'woo-product-variation-gallery'),
                        'desc'     => 'For medium devices.<br>' . esc_html__('Slider gallery width in pixel for medium devices, small desktop. Default value is: 0. Limit: 0-1000. Media query (max-width : 992px)', 'woo-product-variation-gallery'),
                        'id'       => 'gallery_md_width',
                        'min'      => 0,
                        'max'      => 1000,
                        'step'     => 1,
                        'suffix'   => 'px'
                    ),
                    array(
                        'title'    => esc_html__('Gallery Width (Small Device)', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_gallery_sm_width', 720)),
                        'desc_tip' => esc_html__('Slider gallery width in px for small devices, tablets', 'woo-product-variation-gallery'),
                        'desc'     => 'For small devices, tablets.<br>' . esc_html__('Slider gallery width in pixel for medium devices, small desktop. Default value is: 720. Limit: 0-1000. Media query (max-width : 768px)', 'woo-product-variation-gallery'),
                        'id'       => 'gallery_sm_width',
                        'min'      => 0,
                        'max'      => 1000,
                        'step'     => 1,
                        'suffix'   => 'px'
                    ),
                    array(
                        'title'    => esc_html__('Gallery Width (Extra Small Device)', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_gallery_xsm_width', 320)),
                        'desc_tip' => esc_html__('Slider gallery width in px for extra small devices, phones', 'woo-product-variation-gallery'),
                        'desc'     => 'For extra small devices, mobile.<br>' . esc_html__('Slider gallery width in pixel for extra small devices, phones. Default value is: 320. Limit: 0-1000. Media query (max-width : 480px)', 'woo-product-variation-gallery'),
                        'id'       => 'gallery_xsm_width',
                        'min'      => 0,
                        'max'      => 1000,
                        'step'     => 1,
                        'suffix'   => 'px'
                    ),
                    array(
                        'title'    => esc_html__('Gallery Bottom Gap', 'woo-product-variation-gallery'),
                        'type'     => 'number',
                        'default'  => absint(apply_filters('rtwpvg_gallery_margin', 30)),
                        'desc_tip' => esc_html__('Slider gallery bottom margin in pixel', 'woo-product-variation-gallery'),
                        'desc'     => sprintf(esc_html__('Slider gallery bottom margin in pixel. Default value is: %d. Limit: 10-100.', 'woo-product-variation-gallery'), apply_filters('gallery_margin', 30)),
                        'id'       => 'gallery_margin',
                        'min'      => 10,
                        'max'      => 100,
                        'step'     => 1,
                        'suffix'   => 'px'
                    ),
                    array(
                        'title'   => esc_html__('Reset Variation Gallery', 'woo-product-variation-gallery'),
                        'type'    => 'checkbox',
                        'default' => true,
                        'desc'    => esc_html__('Always Reset Gallery After Variation Select', 'woo-product-variation-gallery'),
                        'id'      => 'reset_on_variation_change'
                    )
                ))
            ),
            'advanced'        => array(
                'id'     => 'advanced',
                'title'  => esc_html__('Advanced', 'woo-product-variation-gallery'),
                'desc'   => esc_html__('Advanced change some visual styles', 'woo-product-variation-gallery'),
                'fields' => apply_filters('rtwpvg_advanced_setting_fields', array(
                    array(
                        'title'   => esc_html__('Zoom Gallery image', 'woo-product-variation-gallery'),
                        'type'    => 'checkbox',
                        'default' => true,
                        'desc'    => esc_html__('Enable', 'woo-product-variation-gallery'),
                        'id'      => 'zoom'
                    ),
                    array(
                        'title'   => esc_html__('LightBox', 'woo-product-variation-gallery'),
                        'type'    => 'checkbox',
                        'default' => true,
                        'desc'    => esc_html__('Enable', 'woo-product-variation-gallery'),
                        'id'      => 'lightbox'
                    ),
                    array(
                        'id'   => 'pro_feature',
                        'type' => 'feature',
                        'html' => sprintf('<img src="%s" alt="%s">',
                            rtwpvg()->get_images_uri('thumbnail-pro-feature.jpg'),
                            esc_html__('Thumbnail pro feature', 'woo-product-variation-gallery')
                        )
                    ),
                    array(
                        'title'   => esc_html__('Preload Style', 'woo-product-variation-gallery'),
                        'type'    => 'select',
                        'default' => 'blur',
                        'id'      => 'preload_style',
                        'options' => array(
                            'blur' => esc_html__('Blur', 'woo-product-variation-gallery'),
                            'fade' => esc_html__('Fade', 'woo-product-variation-gallery'),
                            'gray' => esc_html__('Gray', 'woo-product-variation-gallery'),
                        )
                    ),
                    array(
                        'title'   => esc_html__('Zoom Button Position', 'woo-product-variation-gallery'),
                        'type'    => 'select',
                        'default' => 'top-right',
                        'id'      => 'zoom_position',
                        'options' => array(
                            'top-right'    => esc_html__('Top right', 'woo-product-variation-gallery'),
                            'top-left'     => esc_html__('Top left', 'woo-product-variation-gallery'),
                            'bottom-right' => esc_html__('Bottom right', 'woo-product-variation-gallery'),
                            'bottom-left'  => esc_html__('Bottom left', 'woo-product-variation-gallery'),
                        )
                    )
                ))
            ),
            'tools'           => array(
                'id'     => 'tools',
                'title'  => esc_html__('Tools', 'woo-product-variation-gallery'),
                'desc'   => esc_html__('Tools define some system tasks', 'woo-product-variation-gallery'),
                'active' => apply_filters('rtwpvg_tools_setting_active', false),
                'fields' => apply_filters('rtwpvg_tools_setting_fields', array(
                    array(
                        'id'    => 'remove_all_data',
                        'type'  => 'checkbox',
                        'title' => esc_html__('
Enable to delete all data', 'woo-product-variation-gallery'),
                        'desc'  => esc_html__('Enable / Disable Allow to delete all data for WooCommerce Product variation Gallery plugin during delete this plugin', 'woo-product-variation-gallery')
                    )
                ))
            ),
            'premium_plugins' => array(
                'id'     => 'premium_plugins',
                'title'  => esc_html__('Premium Plugins', 'woo-product-variation-gallery'),
                'desc'   => esc_html__('You can try our premium plugins', 'woo-product-variation-gallery'),
                'fields' => apply_filters('rtwpvg_premium_plugins_setting_fields', array(
                    array(
                        'id'         => 'premium_feature',
                        'type'       => 'feature',
                        'attributes' => array(
                            'class' => 'rt-feature'
                        ),
                        'html'       => Functions::get_product_list_html(array(
                            'rtwpvs-pro' => array(
                                'title'     => "WooCommerce Variation Swatches Pro",
                                'price'     => 29,
                                'image_url' => rtwpvg()->get_images_uri('rtwpvs-pro.png'),
                                'url'       => 'https://www.radiustheme.com/downloads/woocommerce-variation-swatches/',
                                'demo_url'  => 'https://www.radiustheme.com/downloads/woocommerce-variation-swatches/',
                                'buy_url'   => 'https://www.radiustheme.com/downloads/woocommerce-variation-swatches/',
                                'doc_url'   => 'https://www.radiustheme.com/setup-configure-woocommerce-product-variation-swatches-pro/'
                            ),
                            'rtwpvg-pro' => array(
                                'price'     => 29,
                                'title'     => "WooCommerce Variation images gallery PRO",
                                'image_url' => rtwpvg()->get_images_uri('rtwpvg-pro.png'),
                                'url'       => 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery/',
                                'demo_url'  => 'https://radiustheme.com/demo/wordpress/woopluginspro/product/woocommerce-variation-images-gallery/',
                                'buy_url'   => 'https://www.radiustheme.com/downloads/woocommerce-variation-images-gallery/',
                                'doc_url'   => 'https://www.radiustheme.com/how-to-use-woocommerce-variation-images-gallery-pro/'
                            ),
                            'metro'     => array(
                                'title'     => "Metro – Minimal WooCommerce WordPress Theme",
                                'image_url' => rtwpvg()->get_images_uri('metro.jpg'),
                                'url'       => 'https://www.radiustheme.com/downloads/metro-minimal-woocommerce-wordpress-theme/',
                                'demo_url'  => 'https://www.radiustheme.com/demo/wordpress/themes/metro/preview/',
                                'buy_url'   => 'https://www.radiustheme.com/downloads/metro-minimal-woocommerce-wordpress-theme/',
                                'doc_url'   => 'https://www.radiustheme.com/demo/wordpress/themes/metro/docs/'
                            )
                        ))
                    )
                ))
            )
        );

        return apply_filters('rtwpvg_settings_fields', $fields);
    }

}
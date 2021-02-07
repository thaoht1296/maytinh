<?php

namespace Essential_Addons_Elementor\Template\Content;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

trait Post_Grid
{
    public static function render_template_($args, $settings)
    {

        $query = new \WP_Query($args);
         
        ob_start();

        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                echo '<article class="eael-grid-post eael-post-grid-column" data-id="'.get_the_ID().'">
                    <div class="eael-grid-post-holder">
                        <div class="eael-grid-post-holder-inner">';
                            if (has_post_thumbnail() && $settings['eael_show_image'] == 'yes') {

                                echo '<div class="eael-entry-media">';
                                    if($settings['eael_show_post_terms'] === 'yes') {                            
                                        echo self::get_terms_as_list($settings['eael_post_terms'], $settings['eael_post_terms_max_length']);
                                    }

                                        echo '<div class="eael-entry-overlay ' . $settings['eael_post_grid_hover_animation'] . '">';
                                            if( isset($settings['eael_post_grid_bg_hover_icon']['url']) ) {
                                                echo '<img src="'.esc_url($settings['eael_post_grid_bg_hover_icon']['url']).'" alt="'.esc_attr(get_post_meta($settings['eael_post_grid_bg_hover_icon']['id'], '_wp_attachment_image_alt', true)).'" />';
                                            }else {
                                                echo '<i class="' . $settings['eael_post_grid_bg_hover_icon'] . '" aria-hidden="true"></i>';
                                            }
                                            echo '<a
                                                href="' . get_the_permalink() . '"
                                                '.($settings['image_link_nofollow'] ? 'rel="nofollow"' : '').'
                                                '.($settings['image_link_target_blank'] ? 'target="_blank"' : '').'
                                            ></a>';
                                        echo '</div>';

                                    echo '<div class="eael-entry-thumbnail">
                                        <img src="' . esc_url(wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size'])) . '" alt="' . esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) . '">
                                    </div>';
                                echo '</div>';
                            }

                            if ($settings['eael_show_title'] || $settings['eael_show_meta'] || $settings['eael_show_excerpt']) {
                                echo '<div class="eael-entry-wrapper">
                                    <header class="eael-entry-header">';
                                        if ($settings['eael_show_title']) {
                                            echo '<h2 class="eael-entry-title">';
                                                echo '<a
                                                class="eael-grid-post-link"
                                                href="' . get_the_permalink() . '"
                                                title="' . get_the_title() . '"
                                                '.($settings['title_link_nofollow'] ? 'rel="nofollow"' : '').'
                                                '.($settings['title_link_target_blank'] ? 'target="_blank"' : '').'
                                                >';
                                                
                                                if(empty($settings['eael_title_length'])) {
                                                    echo get_the_title();
                                                }else {
                                                    echo implode(" ", array_slice(explode(" ", get_the_title() ), 0, $settings['eael_title_length']));
                                                }
                                                echo '</a>';
                                            echo '</h2>';
                                        }

                                        if ($settings['eael_show_meta'] && $settings['meta_position'] == 'meta-entry-header') {
                                            echo '<div class="eael-entry-meta">';
                                                if($settings['eael_show_author'] === 'yes') {
                                                    echo '<span class="eael-posted-by">' . get_the_author_meta( 'display_name' ) . '</span>';
                                                }
                                                if($settings['eael_show_date'] === 'yes') {
                                                    echo '<span class="eael-posted-on"><time datetime="' . get_the_date() . '">' . get_the_date() . '</time></span>';
                                                }
                                            echo '</div>';
                                        }
                                    echo '</header>';

                                    if ($settings['eael_show_excerpt']) {
                                        echo '<div class="eael-entry-content">
                                            <div class="eael-grid-post-excerpt">';
                                                if(empty($settings['eael_excerpt_length'])) {
                                                    echo '<p>'.strip_shortcodes(get_the_excerpt() ? get_the_excerpt() : get_the_content()).'</p>';
                                                }else {
                                                    echo '<p>'.wp_trim_words(strip_shortcodes(get_the_excerpt() ? get_the_excerpt() : get_the_content()), $settings['eael_excerpt_length'], $settings['excerpt_expanison_indicator']).'</p>';
                                                }

                                                if ($settings['eael_show_read_more_button']) {
                                                    echo '<a
                                                    href="' . get_the_permalink() . '"
                                                    class="eael-post-elements-readmore-btn"
                                                    '.($settings['read_more_link_nofollow'] ? 'rel="nofollow"' : '').'
                                                    '.($settings['read_more_link_target_blank'] ? 'target="_blank"' : '').'
                                                    >' . esc_attr($settings['read_more_button_text']) . '</a>';
                                                }
                                            echo '</div>
                                        </div>';
                                    }
                                echo '</div>';

                                if ($settings['eael_show_meta'] && $settings['meta_position'] == 'meta-entry-footer') {
                                    echo '<div class="eael-entry-footer">';

                                        if($settings['eael_show_avatar'] === 'yes') {
                                            echo '<div class="eael-author-avatar">
                                                <a href="' . get_author_posts_url(get_the_author_meta('ID')) . '">' . get_avatar(get_the_author_meta('ID'), 96) . '</a>
                                            </div>';
                                        }
                                        

                                        echo '<div class="eael-entry-meta">';
                                            if($settings['eael_show_author'] === 'yes') {
                                                echo '<div class="eael-posted-by">' . get_the_author_posts_link() . '</div>';
                                            }

                                            if($settings['eael_show_date'] === 'yes') {
                                                echo '<div class="eael-posted-on"><time datetime="' . get_the_date() . '">' . get_the_date() . '</time></div>';
                                            }
                                        echo '</div>';

                                    echo '</div>';
                                }
                            }
                        echo '</div>
                    </div>
                </article>';
            }
        } else {
            _e('<p class="no-posts-found">No posts found!</p>', 'essential-addons-for-elementor-lite');
        }

        wp_reset_postdata();

        return ob_get_clean();
    }
}
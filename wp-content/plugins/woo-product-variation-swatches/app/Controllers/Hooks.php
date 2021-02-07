<?php

namespace Rtwpvs\Controllers;

use Rtwpvs\Helpers\Functions;
use Rtwpvs\Helpers\Options;

class Hooks
{

    static function init() {
        add_filter('product_attributes_type_selector', array(__CLASS__, 'product_attributes_types'));
        add_action('admin_init', array(__CLASS__, 'add_product_taxonomy_meta'));
        add_action('woocommerce_product_option_terms', array(__CLASS__, 'product_option_terms'), 20, 2);
        add_action('dokan_product_option_terms', array(__CLASS__, 'product_option_terms'), 20, 2);
        add_filter('woocommerce_dropdown_variation_attribute_options_html', array(
            __CLASS__,
            'variation_attribute_options_html'
        ), 200, 2);
        if (!is_admin()) {
            add_filter('woocommerce_ajax_variation_threshold', array(__CLASS__, 'ajax_variation_threshold'), 8);
        }
        add_filter('woocommerce_available_variation', array(__CLASS__, 'available_variation'), 100, 3);
        add_action('admin_init', array(__CLASS__, 'after_plugin_active'));

        add_filter('script_loader_tag', [__CLASS__, 'script_loader_add_defer_tag'], 10, 3);
        add_action('woocommerce_save_product_variation', [__CLASS__, 'delete_transient_at_save_or_update_product_variation']);
        add_action('woocommerce_update_product_variation', [__CLASS__, 'delete_transient_at_save_or_update_product_variation']);
        add_action('woocommerce_delete_product_transients', [__CLASS__, 'delete_transient_at_delete_product_transients']);
        add_action('woocommerce_attribute_updated', [__CLASS__, 'delete_transient_at_attribute_updated'], 20, 3);
        add_action('woocommerce_attribute_deleted', [__CLASS__, 'delete_transient_at_attribute_deleted'], 20, 3);
        add_action('woocommerce_attribute_added', [__CLASS__, 'delete_transient_at_attribute_added'], 20, 2);

        add_action('init', [__CLASS__, 'delete_transient_at_force']);
    }

    static function delete_transient_at_force() {
        if (isset($_GET['rtwpvs_clear_all_transient'])) {
            $archive_transient_name = "_transient_" . rtwpvs()->get_transient_name("archive_%", 'attribute-html');
            $product_transient_name = "_transient_" . rtwpvs()->get_transient_name("%", 'attribute-html');
            global $wpdb;
            $wpdb->query($wpdb->prepare("DELETE FROM $wpdb->options WHERE `option_name` LIKE (%s) OR `option_name` LIKE (%s) ", $archive_transient_name, $product_transient_name));
            do_action('rtwpvs_clear_all_transient');
        }
    }

    function delete_transient_at_attribute_added($attribute_id, $attribute) {
        $transient_name = rtwpvs()->get_transient_name(wc_attribute_taxonomy_name($attribute['attribute_name']), 'attribute-taxonomy');
        delete_transient($transient_name);
    }

    function delete_transient_at_attribute_deleted($attribute_id, $attribute_name, $taxonomy) {
        $transient_name = rtwpvs()->get_transient_name($taxonomy, 'attribute-taxonomy');
        delete_transient($transient_name);
    }

    function delete_transient_at_attribute_updated($attribute_id, $attribute, $old_attribute_name) {
        $transient_name = rtwpvs()->get_transient_name(wc_attribute_taxonomy_name($attribute['attribute_name']), 'attribute-taxonomy');
        $old_transient = sprintf('rtwpvs_get_wc_attribute_taxonomy_%s', wc_attribute_taxonomy_name($old_attribute_name));
        delete_transient($transient_name);
        delete_transient($old_transient);
    }

    function delete_transient_at_delete_product_transients($product_id) {
        $product = wc_get_product($product_id);

        if ($product && $product->is_type('variable')) {
            $attribute_keys = array_keys($product->get_variation_attributes());

            foreach ($attribute_keys as $attribute_id) {
                $transient_id = $product_id . "_" . wc_variation_attribute_name($attribute_id);
                $product_transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
                delete_transient($product_transient_name);
            }
        }
    }

    function delete_transient_at_save_or_update_product_variation($variation_id) {
        $product = wc_get_product($variation_id);
        $product_id = $product->get_parent_id();
        $attribute_keys = array_keys($product->get_variation_attributes());
        foreach ($attribute_keys as $attribute_id) {
            $transient_id = $product_id . "_" . wc_variation_attribute_name($attribute_id);
            $product_transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
            delete_transient($product_transient_name);
        }
    }

    function delete_transient_at_rtwpvs_save_or_reset_product_attributes($product_id) {
        $product = wc_get_product($product_id);
        $attribute_keys = array_keys($product->get_variation_attributes());
        foreach ($attribute_keys as $attribute_id) {
            $transient_id = $product_id . "_" . wc_variation_attribute_name($attribute_id);
            $product_transient_name = rtwpvs()->get_transient_name($transient_id, 'attribute-html');
            delete_transient($product_transient_name);
        }
    }

    static function script_loader_add_defer_tag($tag, $handle, $src) {

        $defer_load_js = (bool)rtwpvs()->get_option('defer_load_js');
        if ($defer_load_js) {
            $handles = array('rtwpvs');
            if (!wp_is_mobile() && in_array($handle, $handles) && (strpos($tag, 'plugins' . DIRECTORY_SEPARATOR . 'woo-product-variation-swatches') !== false)) {
                return str_ireplace(' src=', ' defer src=', $tag);
            }
        }

        return $tag;
    }

    /**
     * @param $variation
     * @param $product      \WC_Product
     * @param $variationObj \WC_Product_Variable
     *
     * @return bool
     */
    static function available_variation($variation, $product, $variationObj) {

        if (rtwpvs()->get_option('disable_out_of_stock')) {
            return $variationObj->is_in_stock() ? $variation : false;
        }

        return $variation;
    }


    static function ajax_variation_threshold($threshold) {
        return absint(rtwpvs()->get_option('threshold', $threshold));
    }

    /**
     * Unused
     */
    static function get_available_product_variations() {
        if (is_ajax() && isset($_GET['product_id'])) {
            $product_id = absint($_GET['product_id']);
            $product = wc_get_product($product_id);
            $available_variations = array_values($product->get_available_variations());

            wp_send_json_success(wp_json_encode($available_variations));
        } else {
            wp_send_json_error();
        }
    }

    static function product_attributes_types($selector) {
        $types = Options::get_available_attributes_types();
        if (!empty($types)) {
            foreach ($types as $key => $type) {
                $selector[$key] = $type;
            }
        }

        return $selector;
    }

    static function add_product_taxonomy_meta() {

        $fields = Options::get_taxonomy_meta_fields();
        $meta_added_for = apply_filters('rtwpvs_product_taxonomy_meta_for', array_keys($fields));

        if (function_exists('wc_get_attribute_taxonomies')):

            $attribute_taxonomies = wc_get_attribute_taxonomies();
            if ($attribute_taxonomies) :
                foreach ($attribute_taxonomies as $tax) :
                    $product_attr = wc_attribute_taxonomy_name($tax->attribute_name);
                    $product_attr_type = $tax->attribute_type;
                    if (in_array($product_attr_type, $meta_added_for)) :
                        new TermMeta($product_attr, $fields[$product_attr_type]);
                        do_action('rtwpvs_wc_attribute_taxonomy_meta_added', $product_attr, $product_attr_type);
                    endif;
                endforeach;
            endif;
        endif;

    }

    static function product_option_terms($attribute_taxonomy, $i) {
        global $thepostid;
        if (in_array($attribute_taxonomy->attribute_type, array_keys(Options::get_available_attributes_types()))) {

            $taxonomy = wc_attribute_taxonomy_name($attribute_taxonomy->attribute_name);

            $product_id = $thepostid;

            if (is_null($thepostid) && isset($_POST['post_id'])) {
                $product_id = absint($_POST['post_id']);
            }

            $args = array(
                'orderby'    => 'name',
                'hide_empty' => 0,
            );
            ?>
            <select multiple="multiple"
                    data-placeholder="<?php esc_attr_e('Select terms', 'woo-product-variation-swatches'); ?>"
                    class="multiselect attribute_values wc-enhanced-select"
                    name="attribute_values[<?php echo $i; ?>][]">
                <?php
                $all_terms = get_terms($taxonomy, apply_filters('woocommerce_product_attribute_terms', $args));
                if ($all_terms) :
                    foreach ($all_terms as $term) :
                        echo '<option value="' . esc_attr($term->term_id) . '" ' . selected(has_term(absint($term->term_id), $taxonomy, $product_id), true, false) . '>' . esc_attr(apply_filters('woocommerce_product_attribute_term_name', $term->name, $term)) . '</option>';
                    endforeach;
                endif;
                ?>
            </select>
            <?php do_action('before_rtwpvs_product_option_terms_button', $attribute_taxonomy, $taxonomy); ?>
            <button class="button plus select_all_attributes"><?php esc_html_e('Select all', 'woo-product-variation-swatches'); ?></button>
            <button class="button minus select_no_attributes"><?php esc_html_e('Select none', 'woo-product-variation-swatches'); ?></button>

            <?php
            $fields = Options::get_available_attributes_types($attribute_taxonomy->attribute_type);

            if (!empty($fields)): ?>
                <button class="button fr plus rtwpvs_add_new_attribute"
                        data-dialog_title="<?php printf(esc_html__('Add new %s', 'woo-product-variation-swatches'), esc_attr($attribute_taxonomy->attribute_label)) ?>"><?php esc_html_e('Add new', 'woo-product-variation-swatches'); ?></button>
            <?php else: ?>
                <button class="button fr plus add_new_attribute"><?php esc_html_e('Add new', 'woo-product-variation-swatches'); ?></button>
            <?php endif; ?>
            <?php
            do_action('after_rtwpvs_product_option_terms_button', $attribute_taxonomy, $taxonomy, $product_id);
        }
    }

    static function variation_attribute_options_html($html, $args) {

        if (apply_filters('default_rtwpvs_variation_attribute_options_html', false, $args, $html)) {
            return $html;
        }

        // WooCommerce Product Bundle Fixing
        if (isset($_POST['action']) && $_POST['action'] === 'woocommerce_configure_bundle_order_item') {
            return $html;
        }

        return Functions::generate_variation_attribute_option_html(apply_filters('rtwpvs_variation_attribute_options_args', $args), $html);

    }

    static function after_plugin_active() {
        if (get_option('rtwpvs_activate') === 'yes') {
            delete_option('rtwpvs_activate');
            wp_safe_redirect(add_query_arg(array(
                'page'    => 'wc-settings',
                'tab'     => 'rtwpvs',
                'section' => 'general',
            ), admin_url('admin.php')));
        }
    }
}
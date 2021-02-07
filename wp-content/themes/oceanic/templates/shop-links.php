<?php
if ( is_user_logged_in() ) {
?>
	<div class="site-header-right-link"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="my-account" title="<?php _e('My Account','oceanic'); ?>"><?php _e('My Account','oceanic'); ?></a></div>
<?php
} else {
?>
	<div class="site-header-right-link"><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="my-account" title="<?php _e('Login','oceanic'); ?>"><?php _e('Đăng nhập / Đăng kí','oceanic'); ?></a></div>
<?php
}
?>
	<div class="header-cart">
		<a class="header-cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e('Xem giỏ hàng', 'oceanic'); ?>">
			<span class="header-cart-amount">
				<?php echo sprintf(_n('%d item', '%d Sản phẩm', WC()->cart->get_cart_contents_count(), 'oceanic'), WC()->cart->get_cart_contents_count());?> - <?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?>
			</span>
			<span class="header-cart-checkout <?php echo ( WC()->cart->get_cart_contents_count() > 0 ) ? 'cart-has-items' : ''; ?>">
				<span><?php esc_attr_e('Thanh toán', 'oceanic'); ?></span> <i class="fa fa-shopping-cart"></i>
			</span>
		</a>
	</div>

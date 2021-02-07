
<div class="site-container">
    
    <div class="site-header-left">

        <?php if( get_header_image() ) : ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><img src="<?php esc_url( header_image() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>" /></a>
        <?php else : ?>
        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="site-title"><?php bloginfo( 'name' ); ?></a>
            <div class="site-description"><?php bloginfo( 'description' ); ?></div>
        <?php endif; ?>
        
    </div><!-- .site-branding -->
    
    <div class="site-header-right">
        
        <?php
        if ( oceanic_is_woocommerce_activated() && get_theme_mod( 'oceanic-header-shop-links', true ) ) {
        	get_template_part( 'templates/shop-links' );
        } else { ?>
            <div class="site-top-bar-left-text"><?php echo wp_kses_post( get_theme_mod( 'oceanic-header-info-text', '<em>CALL US:</em> 555-OCEANIC' ) ) ?></div>
        <?php
        } ?>
        
    </div>
    <div class="clearboth"></div>
    
</div>

<nav id="site-navigation" class="main-navigation" role="navigation">
	<span class="header-menu-button"><i class="fa fa-bars"></i></span>
	<div id="main-menu" class="main-menu-container oceanic-mobile-menu-dark-color-scheme">
		<div class="main-menu-close"><i class="fa fa-angle-right"></i><i class="fa fa-angle-left"></i></div>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'main-navigation-inner' ) ); ?>
	</div>
</nav><!-- #site-navigation -->

<?php
if ( get_theme_mod( 'oceanic-slider-type', false ) == 'oceanic-no-slider' ) : ?>

	<!-- No Slider -->

<?php
elseif ( get_theme_mod( 'oceanic-slider-type', false ) == 'oceanic-meta-slider' ) : ?>
    
    <?php
    $slider_code = '';
    if ( get_theme_mod( 'oceanic-meta-slider-shortcode', false ) ) {
        $slider_code = get_theme_mod( 'oceanic-meta-slider-shortcode' );
    } ?>
    
    <?php echo do_shortcode( esc_html( $slider_code ) ); ?>
    
<?php else : ?>
    
    <?php
    $slider_cats = '';
    if ( get_theme_mod( 'oceanic-slider-cats', false ) ) {
        $slider_cats = get_theme_mod( 'oceanic-slider-cats' );
    }
    ?>
    
    <?php
    if( $slider_cats ) :
    ?>
    
		<?php
		$slider_cats = explode(',', esc_html( $slider_cats ));
		$slider_cat_ids = array();
		
		for ($i=0; $i<count($slider_cats); ++$i) {
			$cat_id = get_cat_ID( $slider_cats[$i] );
			if ($cat_id > 0) $slider_cat_ids[$i] = $cat_id; 
		}

        if ( count($slider_cat_ids) > 0) {
        ?>
        
			<?php $slider_query = new WP_Query( 'cat=' . implode(',', $slider_cat_ids) . '&posts_per_page=-1&orderby=date&order=DESC&id=slider' ); ?>
	        
	        <?php
	        if ( $slider_query->have_posts() ) :
	        ?>
	
				<div class="home-slider-wrap home-slider-remove">
					<div class="home-slider-prev">
						<i class="fa fa-angle-left"></i>
					</div>
					<div class="home-slider-next">
						<i class="fa fa-angle-right"></i>
					</div>
				
					<div class="home-slider">
				                    
						<?php while ( $slider_query->have_posts() ) : $slider_query->the_post(); ?>
				                    
						<div>
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'full', array( 'class' => '' ) ); ?>
							<?php endif; ?>
				                            
							<div class="overlay"><?php the_content(); ?></div>
						</div>
				                    
						<?php endwhile; ?>
				                    
					</div>
					
					<div class="home-slider-pager"></div>
					
				</div>
	
		<?php
			endif;
			wp_reset_query();
		}
		?>
	
    <?php
    else :
   	?>
        
        <div class="home-slider-wrap home-slider-remove">
            <div class="home-slider-prev"><i class="fa fa-angle-left"></i></div>
            <div class="home-slider-next"><i class="fa fa-angle-right"></i></div>
                
            <div class="home-slider">
                
                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/images/demo/slider-default01.jpg" alt="<?php esc_attr_e('Demo Slide One', 'oceanic') ?>" />
                    <div class="overlay">
                        
                    </div>
                </div>
                
                <div>
                    <img src="<?php echo get_template_directory_uri() ?>/images/demo/slider-default02.jpg" alt="<?php esc_attr_e('Demo Slide Two', 'oceanic') ?>" />
                    <div class="overlay">
                        
                    </div>
                </div>
                
            </div>
            <div class="home-slider-pager"></div>
        </div>

    <?php endif; ?>
    
<?php endif; ?>
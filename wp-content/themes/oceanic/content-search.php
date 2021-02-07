<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package oceanic
 */

$has_img = 'post-no-img ';
if ( has_post_thumbnail() ) {
    $has_img = '';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $has_img . 'blog-post-side-layout' ); ?>>
    
    <?php
    $thumbnail_id = get_post_thumbnail_id($post->ID);
    $args = array(
		'p' => $thumbnail_id,
		'post_type' => 'attachment'
    );

    $thumbnail = get_posts( $args );
 	$thumbnail_image = wp_get_attachment_image_src( $thumbnail_id, 'oceanic_blog_img_side' );
	?>
    <div class="post-loop-images">
        
        <div class="post-loop-images-carousel-wrapper post-loop-images-carousel-wrapper-remove">
            <div class="post-loop-images-carousel post-loop-images-carousel-remove">	
				<div>
					<img src="<?php echo $thumbnail_image[0]; ?>" alt="<?php echo $thumbnail[0]->post_title; ?>" />
				</div>
            </div>
            
        </div>
        
    </div>				
    
    <div class="post-loop-content">
    
    	<header class="entry-header">
    		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

    		<?php if ( 'post' == get_post_type() ) : ?>
    		<div class="entry-meta">
    			<?php oceanic_posted_on(); ?>
    		</div><!-- .entry-meta -->
    		<?php endif; ?>
    	</header><!-- .entry-header -->

    	<div class="entry-content">
    		<?php
    			/* translators: %s: Name of current post */
                the_excerpt();
    		?>

    		<?php
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . __( 'Pages:', 'oceanic' ),
    				'after'  => '</div>',
    			) );
    		?>
    	</div><!-- .entry-content -->

    	<footer class="entry-footer">
    		<?php oceanic_entry_footer(); ?>
    	</footer><!-- .entry-footer -->
    
    </div>
    
    <div class="clearboth"></div>
</article><!-- #post-## -->
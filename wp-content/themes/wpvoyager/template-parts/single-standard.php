<?php 
$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
if(empty($layout)) { $layout = 'right-sidebar'; }
$class = ($layout !="full-width") ? "eleven columns" : "sixteen columns" ;

?>
<section class="titlebar">
	<div class="container">
	    <div class="sixteen columns">
	        <h1><?php the_title(); ?></h1>
	        <nav id="breadcrumbs">
	             <?php if(ot_get_option('pp_breadcrumbs','on') == 'on') echo dimox_breadcrumbs(); ?>
	        </nav>
	    </div>
	</div>
</section>
<div id="single-page-container" class="no-photo-no-map">
	<div class="container <?php esc_attr_e($layout); ?>">
		<!-- Blog Posts -->
		<div class="alignment <?php esc_attr_e($class); ?>">

			<div class="page-content">
			<?php 
			if ( ! post_password_required() ) {

				$format = get_post_format(); 
				if('video' == $format) :
				
					$video = get_post_meta($post->ID, '_format_video_embed', true);
					if($video) {
					?>
						<div class="embed">
						    <?php
						      $video = get_post_meta($post->ID, '_format_video_embed', true);
						      if(wp_oembed_get($video)) { echo wp_oembed_get($video); } else { echo $video;}
						    ?>
					  	</div>
				  	<?php }

				endif;

				if('gallery' == $format) :
					$gallery = get_post_meta($post->ID, '_format_gallery', TRUE);
					if($gallery) {
						preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );
						if ( isset( $matches[1] ) ) {
							// Found the IDs in the shortcode
							$ids = explode( ',', $matches[1] );
						} else {  
							// The string is only IDs
							$ids = ! empty( $gallery ) && $gallery != '' ? explode( ',', $gallery ) : array();
						} ?>
						<div class="front-slider royalSlider rsDefault full-width-element">
							<?php
							$image_size = ($layout == 'full-width') ? 'full-content' : 'sb-blog' ;
							foreach ($ids as $imageid) { 
								$image_link = wp_get_attachment_url( $imageid );
					            if ( ! $image_link )
					               continue;
					            $image          = wp_get_attachment_image_src( $imageid, $image_size);
					            $img_info =  	get_post( $imageid );
					           
					            $image_full     = wp_get_attachment_image_src( $imageid, 'full');
					            $image_title    = esc_attr( get_the_title( $imageid ) ); ?>
					            <div class="rsContent">
					            	<a class="view" href="<?php echo esc_url($image_full[0]); ?>">
					            		<img class="rsImg" src="<?php echo esc_url($image[0]); ?>" />
				            		</a>
									<?php if(!empty($img_info->post_excerpt)) { ?>
										<div class="wpvCaption" >
									    	<p><?php echo $img_info->post_excerpt; ?></p>
									    </div>
									<?php } ?>
							    </div>
							   
						<?php 
							} //eof for each
							?>
						</div>
						<div class="clearfix"></div>

					<?php }
				endif;
				
			} //eof password protected ?>
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wpvoyager' ),
						'after'  => '</div>',
					) );

					$metas = ot_get_option('pp_meta_single',array());
					if (in_array("categories", $metas)) { 
						$utility_text = __( 'This entry was posted in %1$s','wpvoyager');
						$categories_list = get_the_category_list( __( ', ', 'wpvoyager' )); 
						printf($utility_text,$categories_list);
					}
					if (in_array("tags", $metas)) {
						the_tags( '<ul class="tagcloud inpost"><li>', '</li><li>', '</li></ul>' ); 
					}
				?>
				<div class="other-content">
					<?php 
						wpv_share_post();
						wpv_about_author();
						wpv_related_posts($post); ?>
						<!-- Related Posts -->

						<?php wpv_post_nav(); ?>
						<div class="clearfix"></div>
						<div class="margin-top-50"></div>

						<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						?>
				</div>
			</div>
		</div>
		<?php if($layout !="full-width") { get_sidebar(); }?>
	</div>
</div>
		<!-- Blog Posts / End -->

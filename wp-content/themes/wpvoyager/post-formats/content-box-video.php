<?php
/**
 * Template part for displaying posts on blog.
 *
 * @package WPVoyager
 */

if ( !has_post_thumbnail() ) { $class = "no-thumb box-item"; } else { $class = "box-item"; }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($class); ?>>
	<?php if ( ! post_password_required() ) { 
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
  	} ?>
	<!-- Post Content -->
	<div class="box-item-text">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<div class="box-meta"><?php wpvoyager_full_posted_on(); ?></div>
			<a href="<?php the_permalink(); ?>" class="button box-button"><?php _e('View More','wpvoyager') ?></a>
	</div>
</article>

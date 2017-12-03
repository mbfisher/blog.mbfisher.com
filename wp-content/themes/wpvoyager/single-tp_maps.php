<?php
/**
 * The template for displaying single posts. Actuall code is in template-parts
 *
 * @package WPVoyager
 */

get_header(); ?>
<?php echo do_shortcode('[tp-custom-map id="'.$post->ID.'" width="100%" height="800px"]' ); ?>

<?php 
$layout  = get_post_meta($post->ID, 'pp_sidebar_layout', true);
if(empty($layout)) { $layout = 'full-width'; }
$class = ($layout !="full-width") ? "eleven columns" : "sixteen columns" ;

?>

<div id="single-page-container" class="no-photo-just-map">
	<div class="container <?php esc_attr_e($layout); ?>">

		<!-- Map Navigation -->
		<ul id="mapnav-buttons">
		    <li><a href="#" id="prevpoint" title="<?php _e('Previous Point On Map','wpvoyager') ?>"><?php _e('Prev','wpvoyager') ?></a></li>
		    <li><a href="#" id="nextpoint" title="<?php _e('Next Point On Map','wpvoyager') ?>"><?php _e('Next','wpvoyager') ?></a></li>
		</ul>

		<div class="sixteen columns">
			<div class="post-title">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php wpvoyager_full_posted_on(); ?>
			</div>
		</div>

			<!-- Blog Posts -->
		
		</div>
		<?php if($layout !="full-width") { get_sidebar(); }?>
	</div>
</div>
<!-- Map
================================================== -->
<?php 

get_footer(); ?>

<?php
/**
 * Template Name: Home Map & boxed
 *
 * Only for demo
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage chow
 * @since chow 1.0
 */

get_header(); 
$mapflag = true; 
$layout = 'full-width';
  echo do_shortcode('[tp-global-map class="alternative"]' );
?>

<!-- Content
================================================== -->

  <div class="container <?php echo esc_attr($layout); ?>">

    <?php 
    $home = ot_get_option('pp_front_page_setup','global');
    if ($home == 'global' || $home == 'single') { ?>
      <!-- Map Navigation -->
      <ul id="mapnav-buttons" class="alternative">
          <li><a href="#" id="prevpoint" title="<?php _e('Previous Point On Map','wpvoyager'); ?>"><?php _e('Prev','wpvoyager') ?></a></li>
          <li><a href="#" id="nextpoint" title="<?php _e('Next Point On Map','wpvoyager'); ?>"><?php _e('Next','wpvoyager') ?></a></li>
      </ul>
    <?php } ?>
  <?php echo wpv_welcome(); ?>
    <!-- Blog Posts -->
    <?php if($layout !="full-width") { ?>
      <div class="eleven columns"> 
    <?php } else { ?>
      <div class="sixteen columns">
    <?php } ?>

    <?php 
       global $paged;
       global $wp_query;
       $temp = $wp_query;
       $wp_query = null;
       $wp_query = new WP_Query();
       $wp_query->query('posts_per_page='.get_option('posts_per_page').'&post_type=post'.'&paged='.$paged);
       while ($wp_query->have_posts()) : $wp_query->the_post(); 
         get_template_part( 'post-formats/content', get_post_format() );
       endwhile;
    ?>
    <?php if($layout =="full-width") { ?></div><?php } ?>
    <!-- Blog Posts / End -->
    
    
    <div class="clearfix"></div>


    <!-- Pagination -->
    <div class="pagination-container alt">
      <?php 
      if(function_exists('wp_pagenavi')) { 
        wp_pagenavi(array(
          'next_text' => '<i class="fa fa-chevron-right"></i>',
          'prev_text' => '<i class="fa fa-chevron-left"></i>',
          'use_pagenavi_css' => false,
          ));
      } else {
        the_posts_navigation(array(
          'prev_text'  => ' ',
                'next_text'  => ' ',
        )); 
      }
      ?>
    </div>
    <?php if($layout !="full-width") { ?>
    </div>
    <?php get_sidebar(); ?>
    <?php } ?>
  </div>

<?php get_footer(); ?>

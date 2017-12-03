<?php
/**
 * Template Name: Home Map & Sidebar
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
$layout = 'right-sidebar';
  echo do_shortcode('[tp-global-map class="alternative"]' );
?>

<!-- Content
================================================== -->

  <div class="container right-sidebar">
    <?php 
    $home = ot_get_option('pp_front_page_setup','global');
    if ($home == 'global' || $home == 'single') { ?>
      <!-- Map Navigation -->
      <ul id="mapnav-buttons" class="alternative">
          <li><a href="#" id="prevpoint" title="<?php _e('Previous Point On Map','wpvoyager'); ?>"><?php _e('Prev','wpvoyager') ?></a></li>
          <li><a href="#" id="nextpoint" title="<?php _e('Next Point On Map','wpvoyager'); ?>"><?php _e('Next','wpvoyager') ?></a></li>
      </ul>
    <?php } ?>

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
        switch ( get_post_format() ) {
          case 'video':
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('alt'); ?>>
              
              <?php if ( ! post_password_required() ) { ?>
                  <div class="embed">
                    <?php
                      $video = get_post_meta($post->ID, '_format_video_embed', true);
                      if(wp_oembed_get($video)) { echo wp_oembed_get($video); } else { echo $video;}
                    ?>
                  </div>
              <?php } ?>
              <!-- Post Content -->
              <div class="post-content">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <?php wpvoyager_posted_on(); ?>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="button"><?php _e('View More','wpvoyager') ?></a>
              </div>
            </article>
            <?php
            break;

          case 'gallery':
            ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('alt'); ?>>
                
                  <?php
              if ( ! post_password_required() ) {
                  $gallery = get_post_meta($post->ID, '_format_gallery', TRUE);
                  preg_match( '/ids=\'(.*?)\'/', $gallery, $matches );
                    if ( isset( $matches[1] ) ) {
                      // Found the IDs in the shortcode
                       $ids = explode( ',', $matches[1] );
                    } else {  
                      // The string is only IDs
                      $ids = ! empty( $gallery ) && $gallery != '' ? explode( ',', $gallery ) : array();
                    }
                    echo '<div class="front-slider rsDefault">';
                    foreach ($ids as $imageid) { ?>
                        <?php   $image_link = wp_get_attachment_url( $imageid );
                                if ( ! $image_link )
                                   continue;
                                $image          = wp_get_attachment_image_src( $imageid, 'sb-blog');
                                $image_title    = esc_attr( get_the_title( $imageid ) ); ?>
                                <a href="<?php the_permalink(); ?>" class="post-img"  title="<?php echo $image_title?>"><img class="rsImg" src="<?php echo $image[0]; ?>" /></a>
                        <?php ?>
                  <?php } //eof for each?>
                 </div>
              <?php } //eof password protected ?>
                <!-- Post Content -->
                <div class="post-content">
                  <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                  <?php wpvoyager_posted_on(); ?>
                  <?php the_excerpt(); ?>
                  <a href="<?php the_permalink(); ?>" class="button"><?php _e('View More','wpvoyager') ?></a>
                </div>
              </article>
            <?php
            break;

          default:
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('alt'); ?>>
              <?php if ( has_post_thumbnail() ) { ?>
                <!-- Thumbnail -->
                <a class="post-img" href="<?php echo esc_url(get_permalink()); ?>">
                  <?php the_post_thumbnail('sb-blog'); ?>
                </a>
              <?php } ?>
              <!-- Post Content -->
              <div class="post-content">
                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <?php wpvoyager_posted_on(); ?>
                <?php the_excerpt(); ?>
                <a href="<?php the_permalink(); ?>" class="button"><?php _e('View More','wpvoyager') ?></a>
              </div>
            </article>
            <?php
            break;

          }
          
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

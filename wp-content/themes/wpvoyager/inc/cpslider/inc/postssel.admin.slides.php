<?php

// action - CREATE new slider
if ( array_key_exists( 'action', $_GET ) && 'save_slides' == $_GET['action'] && array_key_exists( '_wpnonce', $_REQUEST ) ) {

    if ( wp_verify_nonce( $_REQUEST['_wpnonce'], 'postssel' ) ) {

        if (  ! empty( $_POST['slider_name'] ) ) {
            // add the new slide group
            //check if slider with that name exists
            if(isset($_POST['dis_author']) && !empty($_POST['dis_author'])) { $dis_author = $_POST['dis_author'];} else { $dis_author = '';}
            if(isset($_POST['dis_date']) && !empty($_POST['dis_date'])) { $dis_date = $_POST['dis_date'];} else { $dis_date = '';}
            $slides = array(
                'posts' => $_POST['posts'],
                'slidername' => $_POST['slider_name'],
                'slidertype' => 'postssel',
                'autoPlay' => $_POST['autoPlay'],
                'dis_author' => $dis_author,
                'dis_date' => $dis_date,
                'paginationSpeed' => $_POST['paginationSpeed'],
                'slideSpeed' => $_POST['slideSpeed'],
                );
            update_option( 'cp_slider_'.$_POST['slider_name'], $slides );
        }
    }
} ?>

<?php
    $current_slider = get_option( 'cp_slider_'.$_GET['slider'], $default = false );

    if($current_slider) {
        $selectedposts = $current_slider['posts'];
    } else {
        $selectedposts =  array();
    }
?>

<form  name="new-slider-form" id="new-slider-form" method="post" action="admin.php?page=cp-slider&slider=<?php echo esc_attr($_GET['slider']); ?>&action=save_slides">
    <p>This slider will displayed featured images from selected posts:</p>
<table class="form-table">
    <tr valign="top">
        <select id="cpsliderselect" multiple="multiple" name="posts[]" title="Click to select posts">
            <?php
            $args = array(
                'posts_per_page' => -1,
                'post_type'  => array('post','page','post_series'),
                //'meta_key'    => '_thumbnail_id',
                //'post__not_in' => $selectedposts
            );
            $the_query = new WP_Query( $args );
           // The Loop
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();?>
<option <?php if (in_array( $the_query->post->ID, $selectedposts)) { echo "selected "; } ?> value="<?php echo esc_attr($the_query->post->ID); ?>"><?php the_title(); ?></option>
                    <?php
                }
            } else {
                // no posts found
            }        

         ?>
        </select>
    </tr>
    <tr valign="top">
        <?php submit_button(); ?>
    </tr>

<?php wp_nonce_field( 'postssel' ); ?>
<input type="hidden" name="slider_name" value="<?php echo esc_attr($_GET['slider']); ?>">

    </table>

        <h2>Slider visual settings</h2>


        <table class="form-table">

        <tr valign="top">
            <th scope="row">Slider's elements to hide</th>
            <td>
                <input type="checkbox" name="dis_date" value="1" <?php checked( $current_slider['dis_date'], 1 ); ?>>Date<br>
                <input type="checkbox" name="dis_author" value="1" <?php checked( $current_slider['dis_author'], 1 ); ?>>Author<br>
            </td>
        </tr>
        <tr><td colspan="2"><p> - they are displayed by default and it's only for <strong>Style 1</strong></p></td></tr>
     
        <tr valign="top">
            <th scope="row">Auto Play <br> <small>Change to any integrer for example 5000 to play every 5 seconds. Set false to disable</small></th>
            <td>
                <input type="text" name="autoPlay" value="<?php if( !empty($current_slider['autoPlay'])) {
                    echo esc_attr($current_slider['autoPlay']);
                } else {
                    echo 'false';
                } ?>">
            </td>
        </tr>
        <tr valign="top">
            <th scope="row">Slides speed, in ms.</th>
            <td>
                <input type="text" name="slideSpeed" value="<?php if( !empty($current_slider['slideSpeed'])) {
                    echo esc_attr($current_slider['slideSpeed']);
                } else {
                    echo '200';
                } ?>">
            </td>
        </tr>        
        <tr valign="top">
            <th scope="row">Pagination speed, in ms.</th>
            <td>
                <input type="text" name="paginationSpeed" value="<?php if( !empty($current_slider['paginationSpeed'])) {
                    echo esc_attr($current_slider['paginationSpeed']);
                } else {
                    echo '800';
                } ?>">
            </td>
        </tr>
        Slider visual settings
        
        <tr valign="top">
            <th></th>
            <td>
                <?php submit_button(); ?>
            </td>
        </tr>

    </table>
</form>

<?php 
add_action( 'wp_enqueue_scripts', 'wpv_enqueue_styles' );

function wpv_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function my_forcelogin_whitelist( $whitelist ) {
    $whitelist[] = site_url( '/login/' );
    return $whitelist;
}
add_filter('v_forcelogin_whitelist', 'my_forcelogin_whitelist', 10, 1);

?>
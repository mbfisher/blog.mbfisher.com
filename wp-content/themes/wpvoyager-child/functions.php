<?php 
add_action( 'wp_enqueue_scripts', 'wpv_enqueue_styles' );

function wpv_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action('template_redirect', function() {
    if (!is_user_logged_in() && !in_array($_SERVER['REQUEST_URI'], ['/auth/', '/wp-admin/'])) {
        wp_safe_redirect(site_url('/auth/'));
        exit;
    }
});

?>
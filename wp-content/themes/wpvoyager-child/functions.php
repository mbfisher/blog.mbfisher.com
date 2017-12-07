<?php 
add_action( 'wp_enqueue_scripts', 'wpv_enqueue_styles' );

function wpv_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action('template_redirect', function () {
    $auth_url = '/auth.php';

    if (!is_user_logged_in() && !in_array($_SERVER['REQUEST_URI'], [$auth_url, '/wp-admin/', wp_login_url()])) {
        wp_safe_redirect(site_url($auth_url . '?redirect_to=' . urlencode($_SERVER['REQUEST_URI'])));
        exit;
    }

    if (isset($_REQUEST['redirect_to']) && $_SERVER['REQUEST_URI'] != wp_login_url()) {
        wp_safe_redirect(site_url($_REQUEST['redirect_to']));
        exit;
    }
});

add_filter('auth_cookie_expiration', function () {
    return 90 * 24 * 60 * 60; // 90 days
});

add_filter('wpa_change_form_label', function () {
    return 'To log in, please enter your email address:';
});
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

add_filter('wp_mail', function ($email) {
    if (strpos($email['subject'], 'Your username and password info') === false) {
        return $email;
    }

    $nonce = wp_create_nonce('new_user_registration_'.$email['to']);
    $url = wpa_generate_url($email['to'], $nonce);

    $email['subject'] = 'Welcome to the Fishers Travel Blog';
    $email['message'] = <<<EOT
<h2>Welcome to the Fishers' Travel Blog!</h2>
<p>You need to log in to the blog before you can read about our adventures.
Here's a handy link to do that in one click: <a href="$url" target="_blank">log in</a></p>.
<p>If you need to log in again in the future, the site will prompt you to enter your email
address, and you'll be sent another link. This way there's no password to remember!</p>
<p>Enjoy!</p>
<p>Mike & Sam</p>
EOT;

    return $email;
});

<?php
/** Make sure that the WordPress bootstrap has run before continuing. */
require( dirname(__FILE__) . '/wp-load.php' );

//if (is_user_logged_in()) {
//    wp_safe_redirect(site_url());
//    exit;
//}

wp_head();
?>

<header id="header" class="black">
    <div class="container">
        <div class="three columns">
            <!-- Logo -->
            <div id="logo" class="logo-text">
                <h1><a href="https://thefishersblog.herokuapp.com/" title="The Fishers" rel="home">The Fishers</a></h1>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</header>

<div class="container">
    <div style="padding: 55px">
        <h1>Login</h1>
        <?php echo do_shortcode("[passwordless-login]"); ?>
    </div>
</div>
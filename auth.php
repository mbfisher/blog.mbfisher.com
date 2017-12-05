<?php
/** Make sure that the WordPress bootstrap has run before continuing. */
require( dirname(__FILE__) . '/wp-load.php' );

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
    <?php echo do_shortcode("[passwordless-login]"); ?>
</div>
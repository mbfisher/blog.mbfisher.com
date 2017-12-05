<?php
/**
 * Template Name: Login
 */
wp_head(); ?>

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
    <!-- TO SHOW THE PAGE CONTENTS -->
    <?php while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
        <?php the_content(); ?> <!-- Page Content -->
    <?php endwhile; //resetting the page loop ?>

    <?php wp_reset_query(); //resetting the page query ?>
</div>

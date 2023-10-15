<div class="container">
    <?php
    $args = array(
        'post_type' => 'advertisement_type', // Specify the custom post type here
        'posts_per_page' => -1, // Set the number of posts to retrieve (-1 for all)
    );

    $query = new WP_Query($args);
    ?>
    <div class="flex row">
        <div class="col-6" style="height: 400px; background-position: center;background-size: cover; background-image: url('<?php echo get_the_post_thumbnail_url($query->posts[2]->ID, 'post-thumbnail') ?>')"></div>
        <div class="flex col col-6">
            <div class="col-6" style="background-position: center;background-size: cover; background-image: url('<?php echo get_the_post_thumbnail_url($query->posts[1]->ID, 'post-thumbnail') ?>');">
            </div>
            <div class="col-6" style="background-position: center;background-size: cover; background-image: url('<?php echo get_the_post_thumbnail_url($query->posts[0]->ID, 'post-thumbnail') ?>');">
            </div>
        </div>
    </div>

    <?php wp_reset_postdata(); ?>


</div>
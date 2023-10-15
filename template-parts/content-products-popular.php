<?php
$args = array(
    'post_type'      => 'product', // Specify the WooCommerce product post type.
    'posts_per_page' => 6,       // Retrieve all products. You can set a specific number if needed.
    'post_status'    => 'publish', // Retrieve only published products.
);

$products = new WP_Query($args);
if ($products->have_posts()) { ?>
    <div class="container py-4">
        <h1 class="mt-0">Popular Products</h1>
        <div class="popular-products owl-carousel owl-theme">
            <?php
            while ($products->have_posts()) {
                $products->the_post();
            ?>
                <div class="item product-card-owl-wrapper">
                    <a href="<?php echo esc_url(get_permalink(get_the_ID())) ?>">
                        <article class="product-card">
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'post-thumbnail') ?>" width="40px" height="40px" alt="">
                            <div class="product-card-content p-2">
                                <p class="my-0"><?php echo get_the_title() ?></p>
                                <small><?php echo wp_get_post_terms(get_the_ID(), 'product_cat')[0]->name; ?></small>
                                <p class="my-0"><?php echo wc_price(get_post_meta(get_the_ID(), '_regular_price', true)) ?></p>
                            </div>
                        </article>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
<?php

    wp_reset_postdata(); // Restore the global post object.
} else {
    echo 'No products found.';
}
?>
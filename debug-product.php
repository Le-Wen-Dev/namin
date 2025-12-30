<?php
/**
 * Debug Product Template
 * Access: http://namin.local/debug-product.php?product_id=123
 */

require_once('wp-load.php');

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if (!$product_id) {
    // Get first product
    $products = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => 1,
        'post_status' => 'publish'
    ));
    if ($products) {
        $product_id = $products[0]->ID;
    }
}

echo '<h1>Debug Product Template</h1>';
echo '<p>Product ID: ' . $product_id . '</p>';

if ($product_id) {
    $product = get_post($product_id);
    if ($product) {
        echo '<h2>Product Info:</h2>';
        echo '<p>Title: ' . esc_html($product->post_title) . '</p>';
        echo '<p>Post Type: ' . esc_html($product->post_type) . '</p>';
        echo '<p>Status: ' . esc_html($product->post_status) . '</p>';
        echo '<p>Permalink: <a href="' . get_permalink($product_id) . '">' . get_permalink($product_id) . '</a></p>';
        
        // Check template
        $template = locate_template('single-product.php');
        echo '<p>Template Found: ' . ($template ? 'YES - ' . $template : 'NO') . '</p>';
        
        // Check if is_singular works
        global $wp_query;
        $wp_query->queried_object = $product;
        $wp_query->queried_object_id = $product_id;
        $wp_query->is_single = true;
        $wp_query->is_singular = true;
        
        echo '<p>is_singular("product"): ' . (is_singular('product') ? 'YES' : 'NO') . '</p>';
        
        // Test meta
        $price = get_post_meta($product_id, '_product_price', true);
        echo '<p>Price: ' . ($price ? $price : 'Not set') . '</p>';
    } else {
        echo '<p>Product not found!</p>';
    }
} else {
    echo '<p>No product ID provided and no products found.</p>';
}

echo '<hr>';
echo '<h2>All Products:</h2>';
$all_products = get_posts(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'post_status' => 'publish'
));
echo '<ul>';
foreach ($all_products as $prod) {
    echo '<li><a href="' . get_permalink($prod->ID) . '">' . esc_html($prod->post_title) . '</a> (ID: ' . $prod->ID . ')</li>';
}
echo '</ul>';


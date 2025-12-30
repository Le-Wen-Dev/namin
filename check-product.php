<?php
/**
 * Check Product Data from Database
 * Access: http://namin.local/check-product.php?slug=tu-ket-hop-lavabo-s1952000505
 */

require_once('wp-load.php');

$slug = isset($_GET['slug']) ? sanitize_text_field($_GET['slug']) : 'tu-ket-hop-lavabo-s1952000505';

echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Check Product</title>';
echo '<style>body{font-family:Arial;max-width:1200px;margin:20px auto;padding:20px;}table{border-collapse:collapse;width:100%;margin:20px 0;}th,td{border:1px solid #ddd;padding:12px;text-align:left;}th{background:#087bb5;color:white;}</style>';
echo '</head><body>';

echo '<h1>Kiểm tra Sản phẩm từ Database</h1>';
echo '<p><strong>Slug:</strong> ' . esc_html($slug) . '</p>';

// Get product by slug
$product = get_page_by_path($slug, OBJECT, 'product');

if (!$product) {
    echo '<div style="background:#f8d7da;padding:20px;border-radius:8px;margin:20px 0;">';
    echo '<h2 style="color:#842029;">❌ Sản phẩm KHÔNG TÌM THẤY trong database!</h2>';
    echo '<p>Có thể slug không đúng hoặc sản phẩm chưa được publish.</p>';
    echo '</div>';
    
    // Try to find by title
    echo '<h3>Tìm kiếm theo tên:</h3>';
    $products = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => 10,
        's' => 'tu ket hop lavabo',
        'post_status' => 'any'
    ));
    
    if ($products) {
        echo '<ul>';
        foreach ($products as $p) {
            echo '<li><a href="' . get_permalink($p->ID) . '">' . esc_html($p->post_title) . '</a> (ID: ' . $p->ID . ', Slug: ' . $p->post_name . ', Status: ' . $p->post_status . ')</li>';
        }
        echo '</ul>';
    }
} else {
    echo '<div style="background:#d1e7dd;padding:20px;border-radius:8px;margin:20px 0;">';
    echo '<h2 style="color:#0f5132;">✅ Sản phẩm TÌM THẤY trong database!</h2>';
    echo '</div>';
    
    $product_id = $product->ID;
    
    echo '<h2>Thông tin cơ bản:</h2>';
    echo '<table>';
    echo '<tr><th>Field</th><th>Value</th></tr>';
    echo '<tr><td>ID</td><td>' . $product_id . '</td></tr>';
    echo '<tr><td>Title</td><td>' . esc_html($product->post_title) . '</td></tr>';
    echo '<tr><td>Slug</td><td>' . esc_html($product->post_name) . '</td></tr>';
    echo '<tr><td>Status</td><td>' . esc_html($product->post_status) . '</td></tr>';
    echo '<tr><td>Post Type</td><td>' . esc_html($product->post_type) . '</td></tr>';
    echo '<tr><td>Permalink</td><td><a href="' . get_permalink($product_id) . '" target="_blank">' . get_permalink($product_id) . '</a></td></tr>';
    echo '<tr><td>Content</td><td>' . (empty($product->post_content) ? '<em>Trống</em>' : wp_trim_words($product->post_content, 50)) . '</td></tr>';
    echo '</table>';
    
    // Get all meta data
    echo '<h2>Meta Data (Custom Fields):</h2>';
    $all_meta = get_post_meta($product_id);
    
    echo '<table>';
    echo '<tr><th>Meta Key</th><th>Value</th></tr>';
    
    $important_meta = array(
        '_product_price' => 'Giá sản phẩm',
        '_product_sale_price' => 'Giá khuyến mãi',
        '_product_sku' => 'Mã SKU',
        '_product_stock' => 'Tồn kho',
        '_product_variants' => 'Biến thể',
        '_product_gallery' => 'Gallery'
    );
    
    foreach ($important_meta as $key => $label) {
        $value = get_post_meta($product_id, $key, true);
        echo '<tr>';
        echo '<td><strong>' . esc_html($label) . '</strong><br><code>' . esc_html($key) . '</code></td>';
        echo '<td>';
        if (is_array($value)) {
            echo '<pre>' . print_r($value, true) . '</pre>';
        } else {
            echo esc_html($value ? $value : '<em>Chưa có dữ liệu</em>');
        }
        echo '</td>';
        echo '</tr>';
    }
    
    // Show all other meta
    foreach ($all_meta as $key => $values) {
        if (!isset($important_meta[$key]) && !strpos($key, '_edit_') && !strpos($key, '_wp_')) {
            $value = is_array($values) ? $values[0] : $values;
            if (strlen($value) < 200) { // Only show short values
                echo '<tr>';
                echo '<td><code>' . esc_html($key) . '</code></td>';
                echo '<td>' . esc_html($value) . '</td>';
                echo '</tr>';
            }
        }
    }
    echo '</table>';
    
    // Check featured image
    echo '<h2>Hình ảnh:</h2>';
    if (has_post_thumbnail($product_id)) {
        $thumb_url = get_the_post_thumbnail_url($product_id, 'full');
        echo '<p><strong>Featured Image:</strong></p>';
        echo '<img src="' . esc_url($thumb_url) . '" style="max-width:300px;border:2px solid #ddd;border-radius:8px;">';
    } else {
        echo '<p><em>Chưa có featured image</em></p>';
    }
    
    // Check categories
    echo '<h2>Danh mục:</h2>';
    $categories = get_the_terms($product_id, 'product_category');
    if ($categories && !is_wp_error($categories)) {
        echo '<ul>';
        foreach ($categories as $cat) {
            echo '<li>' . esc_html($cat->name) . ' (Slug: ' . esc_html($cat->slug) . ')</li>';
        }
        echo '</ul>';
    } else {
        echo '<p><em>Chưa có danh mục</em></p>';
    }
    
    // Test template
    echo '<h2>Template Check:</h2>';
    $template = locate_template('single-product.php');
    echo '<p><strong>Template file:</strong> ' . ($template ? esc_html($template) : '<span style="color:red;">KHÔNG TÌM THẤY</span>') . '</p>';
    
    // Simulate what template would see
    echo '<h2>Dữ liệu Template sẽ nhận được:</h2>';
    echo '<table>';
    echo '<tr><th>Variable</th><th>Value</th></tr>';
    
    $test_price = get_post_meta($product_id, '_product_price', true);
    $test_sale = get_post_meta($product_id, '_product_sale_price', true);
    $test_sku = get_post_meta($product_id, '_product_sku', true);
    $test_stock = get_post_meta($product_id, '_product_stock', true);
    $test_variants = get_post_meta($product_id, '_product_variants', true);
    $test_gallery = get_post_meta($product_id, '_product_gallery', true);
    
    echo '<tr><td>$product_price</td><td>' . ($test_price ? number_format($test_price, 0, ',', '.') . ' đ' : '<em>Trống</em>') . '</td></tr>';
    echo '<tr><td>$product_sale_price</td><td>' . ($test_sale ? number_format($test_sale, 0, ',', '.') . ' đ' : '<em>Trống</em>') . '</td></tr>';
    echo '<tr><td>$product_sku</td><td>' . ($test_sku ? esc_html($test_sku) : '<em>Trống</em>') . '</td></tr>';
    echo '<tr><td>$product_stock</td><td>' . ($test_stock ? esc_html($test_stock) : '<em>Trống</em>') . '</td></tr>';
    echo '<tr><td>$product_variants</td><td>' . (is_array($test_variants) && !empty($test_variants) ? count($test_variants) . ' biến thể' : '<em>Trống</em>') . '</td></tr>';
    echo '<tr><td>$product_gallery</td><td>' . (is_array($test_gallery) && !empty($test_gallery) ? count($test_gallery) . ' ảnh' : '<em>Trống</em>') . '</td></tr>';
    
    $test_image = '';
    if (has_post_thumbnail($product_id)) {
        $test_image = get_the_post_thumbnail_url($product_id, 'full');
    }
    echo '<tr><td>$product_image</td><td>' . ($test_image ? '<img src="' . esc_url($test_image) . '" style="max-width:100px;">' : '<em>Trống</em>') . '</td></tr>';
    
    echo '</table>';
    
    // Test if template can be accessed
    echo '<h2>Test Template Access:</h2>';
    echo '<p><a href="' . get_permalink($product_id) . '" target="_blank" style="padding:10px 20px;background:#087bb5;color:white;text-decoration:none;border-radius:5px;">Mở trang sản phẩm</a></p>';
}

echo '<hr>';
echo '<p><a href="' . home_url() . '">← Về trang chủ</a> | <a href="' . admin_url('edit.php?post_type=product') . '">Quản lý sản phẩm</a></p>';

echo '</body></html>';
?>


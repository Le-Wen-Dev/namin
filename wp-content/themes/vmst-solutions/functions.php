<?php
/**
 * VMST Solutions Theme Functions
 * 
 * Contact: 0832 57 59 05
 * 
 * @package VMST_Solutions
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
 */
function vmst_solutions_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'vmst-solutions'),
        'footer' => __('Footer Menu', 'vmst-solutions'),
    ));
}
add_action('after_setup_theme', 'vmst_solutions_setup');

/**
 * Enqueue Scripts and Styles
 */
function vmst_solutions_scripts() {
    $theme_version = wp_get_theme()->get('Version');
    
    // Styles - Load in correct order
    wp_enqueue_style('vmst-solutions-defaults', get_template_directory_uri() . '/assets/css/defaults.css', array(), $theme_version);
    wp_enqueue_style('vmst-solutions-homepage', get_template_directory_uri() . '/assets/css/homepage.css', array('vmst-solutions-defaults'), $theme_version);
    wp_enqueue_style('vmst-solutions-main', get_template_directory_uri() . '/assets/css/main.css', array('vmst-solutions-defaults', 'vmst-solutions-homepage'), $theme_version);
    wp_enqueue_style('vmst-solutions-style', get_stylesheet_uri(), array('vmst-solutions-main'), $theme_version);
    
    // Scripts
    wp_enqueue_script('vmst-solutions-main', get_template_directory_uri() . '/assets/js/main.js', array(), $theme_version, true);
    
    // Localize script for AJAX
    wp_localize_script('vmst-solutions-main', 'vmstAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vmst-nonce'),
        'homeUrl' => home_url('/'),
    ));
}
add_action('wp_enqueue_scripts', 'vmst_solutions_scripts');

/**
 * Register Widget Areas
 */
function vmst_solutions_widgets_init() {
    register_sidebar(array(
        'name' => __('Footer Widget Area', 'vmst-solutions'),
        'id' => 'footer-widgets',
        'description' => __('Add widgets here to appear in your footer.', 'vmst-solutions'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'vmst_solutions_widgets_init');

/**
 * Customizer Settings
 */
function vmst_solutions_customize_register($wp_customize) {
    // Add contact phone number setting
    $wp_customize->add_setting('vmst_contact_phone', array(
        'default' => '0832 57 59 05',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('vmst_contact_phone', array(
        'label' => __('Contact Phone', 'vmst-solutions'),
        'section' => 'title_tagline',
        'type' => 'text',
    ));
}
add_action('customize_register', 'vmst_solutions_customize_register');

/**
 * Register Custom Post Types
 */
function vmst_solutions_register_post_types() {
    // Tuyển dụng (Jobs)
    register_post_type('job', array(
        'labels' => array(
            'name' => __('Tuyển dụng', 'vmst-solutions'),
            'singular_name' => __('Tuyển dụng', 'vmst-solutions'),
            'add_new' => __('Thêm mới', 'vmst-solutions'),
            'add_new_item' => __('Thêm tuyển dụng mới', 'vmst-solutions'),
            'edit_item' => __('Chỉnh sửa tuyển dụng', 'vmst-solutions'),
            'new_item' => __('Tuyển dụng mới', 'vmst-solutions'),
            'view_item' => __('Xem tuyển dụng', 'vmst-solutions'),
            'search_items' => __('Tìm kiếm tuyển dụng', 'vmst-solutions'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-businessperson',
        'rewrite' => array('slug' => 'tuyen-dung'),
    ));
    
    // Báo giá (Pricing Groups)
    register_post_type('pricing_group', array(
        'labels' => array(
            'name' => __('Nhóm báo giá', 'vmst-solutions'),
            'singular_name' => __('Nhóm báo giá', 'vmst-solutions'),
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-money-alt',
    ));
}
add_action('init', 'vmst_solutions_register_post_types');

/**
 * Register Custom Taxonomies
 */
function vmst_solutions_register_taxonomies() {
    // Job Categories
    register_taxonomy('job_category', 'job', array(
        'labels' => array(
            'name' => __('Danh mục tuyển dụng', 'vmst-solutions'),
            'singular_name' => __('Danh mục', 'vmst-solutions'),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'danh-muc-tuyen-dung'),
    ));
}
add_action('init', 'vmst_solutions_register_taxonomies');

/**
 * Handle Contact Form Submission to Google Sheets
 */
function vmst_handle_contact_form() {
    check_ajax_referer('vmst-nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $message = sanitize_textarea_field($_POST['message']);
    
    // Google Sheets Webhook URL (cần cấu hình)
    $webhook_url = get_option('vmst_google_sheets_webhook', '');
    
    if (!empty($webhook_url)) {
        $data = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message,
            'date' => current_time('mysql'),
        );
        
        wp_remote_post($webhook_url, array(
            'body' => json_encode($data),
            'headers' => array('Content-Type' => 'application/json'),
        ));
    }
    
    // Save to WordPress database with metadata
    $post_id = wp_insert_post(array(
        'post_title' => 'Contact: ' . $name,
        'post_content' => $message,
        'post_status' => 'private',
        'post_type' => 'contact_submission',
    ));
    
    if ($post_id) {
        update_post_meta($post_id, '_contact_name', $name);
        update_post_meta($post_id, '_contact_email', $email);
        update_post_meta($post_id, '_contact_phone', $phone);
    }
    
    wp_send_json_success(array('message' => __('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.', 'vmst-solutions')));
}
add_action('wp_ajax_vmst_contact_form', 'vmst_handle_contact_form');
add_action('wp_ajax_nopriv_vmst_contact_form', 'vmst_handle_contact_form');

/**
 * Handle Pricing Group CRUD
 */
function vmst_handle_pricing_crud() {
    check_ajax_referer('vmst-nonce', 'nonce');
    
    $action = sanitize_text_field($_POST['pricing_action']);
    
    if ($action === 'add') {
        $title = sanitize_text_field($_POST['title']);
        $images = array_map('esc_url_raw', $_POST['images']);
        
        $post_id = wp_insert_post(array(
            'post_title' => $title,
            'post_type' => 'pricing_group',
            'post_status' => 'publish',
        ));
        
        update_post_meta($post_id, '_pricing_images', $images);
        
        wp_send_json_success(array('id' => $post_id));
    } elseif ($action === 'update') {
        $post_id = intval($_POST['id']);
        $title = sanitize_text_field($_POST['title']);
        $images = array_map('esc_url_raw', $_POST['images']);
        
        wp_update_post(array(
            'ID' => $post_id,
            'post_title' => $title,
        ));
        
        update_post_meta($post_id, '_pricing_images', $images);
        
        wp_send_json_success();
    } elseif ($action === 'delete') {
        $post_id = intval($_POST['id']);
        wp_delete_post($post_id, true);
        wp_send_json_success();
    }
}
add_action('wp_ajax_vmst_pricing_crud', 'vmst_handle_pricing_crud');

/**
 * Register Additional Custom Post Types for Dashboard
 */
function vmst_register_dashboard_post_types() {
    // Sản phẩm (Products with Variants)
    register_post_type('product', array(
        'labels' => array(
            'name' => __('Sản phẩm', 'vmst-solutions'),
            'singular_name' => __('Sản phẩm', 'vmst-solutions'),
            'add_new' => __('Thêm sản phẩm', 'vmst-solutions'),
            'add_new_item' => __('Thêm sản phẩm mới', 'vmst-solutions'),
            'edit_item' => __('Chỉnh sửa sản phẩm', 'vmst-solutions'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-cart',
        'rewrite' => array('slug' => 'san-pham'),
        'show_in_menu' => false, // Will add to custom menu
    ));
    
    // Dự án (Projects/Portfolio)
    register_post_type('project', array(
        'labels' => array(
            'name' => __('Dự án', 'vmst-solutions'),
            'singular_name' => __('Dự án', 'vmst-solutions'),
            'add_new' => __('Thêm dự án', 'vmst-solutions'),
            'add_new_item' => __('Thêm dự án mới', 'vmst-solutions'),
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-portfolio',
        'rewrite' => array('slug' => 'du-an'),
        'show_in_menu' => false,
    ));
    
    // Đơn hàng (Orders)
    register_post_type('order', array(
        'labels' => array(
            'name' => __('Đơn hàng', 'vmst-solutions'),
            'singular_name' => __('Đơn hàng', 'vmst-solutions'),
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-clipboard',
        'show_in_menu' => false,
    ));
    
    // Khách hàng (Customers)
    register_post_type('customer', array(
        'labels' => array(
            'name' => __('Khách hàng', 'vmst-solutions'),
            'singular_name' => __('Khách hàng', 'vmst-solutions'),
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-groups',
        'show_in_menu' => false,
    ));
    
    // Contact Submissions
    register_post_type('contact_submission', array(
        'labels' => array(
            'name' => __('Form Liên hệ', 'vmst-solutions'),
            'singular_name' => __('Liên hệ', 'vmst-solutions'),
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-email-alt',
        'show_in_menu' => false,
    ));
}
add_action('init', 'vmst_register_dashboard_post_types');

/**
 * Flush rewrite rules on theme activation
 */
function vmst_flush_rewrite_rules() {
    vmst_register_dashboard_post_types();
    vmst_register_product_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'vmst_flush_rewrite_rules');

/**
 * Ensure product post type is queryable
 */
function vmst_product_query_vars($vars) {
    $vars[] = 'product';
    return $vars;
}
add_filter('query_vars', 'vmst_product_query_vars');

/**
 * Force product template to be used
 */
function vmst_check_product_template($template) {
    global $post;
    
    // Check if this is a single product page
    if (is_singular('product') || (isset($post) && $post->post_type === 'product' && is_single())) {
        $product_template = locate_template(array('single-product.php'));
        if ($product_template) {
            return $product_template;
        }
    }
    
    // Check if this is product archive
    if (is_post_type_archive('product') || (isset($post) && $post->post_type === 'product' && is_archive())) {
        $archive_template = locate_template(array('archive-product.php'));
        if ($archive_template) {
            return $archive_template;
        }
    }
    
    return $template;
}
add_filter('template_include', 'vmst_check_product_template', 99);

/**
 * Register Taxonomies for Products
 */
function vmst_register_product_taxonomies() {
    // Product Categories
    register_taxonomy('product_category', 'product', array(
        'labels' => array(
            'name' => __('Danh mục sản phẩm', 'vmst-solutions'),
            'singular_name' => __('Danh mục', 'vmst-solutions'),
        ),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => array('slug' => 'danh-muc-san-pham'),
    ));
    
    // Project Categories
    register_taxonomy('project_category', 'project', array(
        'labels' => array(
            'name' => __('Danh mục dự án', 'vmst-solutions'),
            'singular_name' => __('Danh mục', 'vmst-solutions'),
        ),
        'hierarchical' => true,
        'public' => true,
    ));
}
add_action('init', 'vmst_register_product_taxonomies');

/**
 * Add Custom Admin Menu
 */
function vmst_add_admin_menu() {
    add_menu_page(
        __('Dashboard Namin', 'vmst-solutions'),
        __('Namin Dashboard', 'vmst-solutions'),
        'manage_options',
        'namin-dashboard',
        'vmst_dashboard_page',
        'dashicons-dashboard',
        2
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Tổng quan', 'vmst-solutions'),
        __('Tổng quan', 'vmst-solutions'),
        'manage_options',
        'namin-dashboard',
        'vmst_dashboard_page'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Quản lý Sản phẩm', 'vmst-solutions'),
        __('Sản phẩm', 'vmst-solutions'),
        'manage_options',
        'edit.php?post_type=product'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Quản lý Dự án', 'vmst-solutions'),
        __('Dự án', 'vmst-solutions'),
        'manage_options',
        'edit.php?post_type=project'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Quản lý Đơn hàng', 'vmst-solutions'),
        __('Đơn hàng', 'vmst-solutions'),
        'manage_options',
        'edit.php?post_type=order'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Quản lý Khách hàng', 'vmst-solutions'),
        __('Khách hàng', 'vmst-solutions'),
        'manage_options',
        'edit.php?post_type=customer'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Thanh toán & Vận chuyển', 'vmst-solutions'),
        __('Thanh toán & Vận chuyển', 'vmst-solutions'),
        'manage_options',
        'namin-payment-shipping',
        'vmst_payment_shipping_page'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Quản lý Bài viết', 'vmst-solutions'),
        __('Bài viết & Trang', 'vmst-solutions'),
        'manage_options',
        'namin-posts-pages',
        'vmst_posts_pages_page'
    );
    
    add_submenu_page(
        'namin-dashboard',
        __('Quản lý Form Liên hệ', 'vmst-solutions'),
        __('Form Liên hệ', 'vmst-solutions'),
        'manage_options',
        'edit.php?post_type=contact_submission'
    );
}
add_action('admin_menu', 'vmst_add_admin_menu');

/**
 * Enqueue Admin Styles and Scripts
 */
function vmst_admin_enqueue_scripts($hook) {
    if (strpos($hook, 'namin') === false) {
        return;
    }
    
    wp_enqueue_style('vmst-admin-style', get_template_directory_uri() . '/admin/css/admin.css', array(), '1.0.0');
    wp_enqueue_script('vmst-admin-script', get_template_directory_uri() . '/admin/js/admin.js', array('jquery'), '1.0.0', true);
    
    wp_localize_script('vmst-admin-script', 'vmstAdmin', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vmst-admin-nonce'),
    ));
}
add_action('admin_enqueue_scripts', 'vmst_admin_enqueue_scripts');

/**
 * Dashboard Page
 */
function vmst_dashboard_page() {
    include get_template_directory() . '/admin/pages/dashboard.php';
}

/**
 * Payment & Shipping Page
 */
function vmst_payment_shipping_page() {
    include get_template_directory() . '/admin/pages/payment-shipping.php';
}

/**
 * Posts & Pages Management Page
 */
function vmst_posts_pages_page() {
    include get_template_directory() . '/admin/pages/posts-pages.php';
}

/**
 * Add Meta Boxes for Products (Variants)
 */
function vmst_add_product_meta_boxes() {
    add_meta_box(
        'product_variants',
        'Biến thể sản phẩm',
        'vmst_product_variants_callback',
        'product',
        'normal',
        'high'
    );
    
    add_meta_box(
        'product_details',
        'Thông tin sản phẩm',
        'vmst_product_details_callback',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vmst_add_product_meta_boxes');

function vmst_product_variants_callback($post) {
    wp_nonce_field('vmst_product_meta', 'vmst_product_meta_nonce');
    $variants = get_post_meta($post->ID, '_product_variants', true);
    if (!is_array($variants)) $variants = array();
    ?>
    <div class="product-variants">
        <div class="variants-list">
            <?php foreach ($variants as $index => $variant) : ?>
                <div class="variant-item">
                    <div class="variant-item-header">
                        <strong>Biến thể <?php echo $index + 1; ?></strong>
                        <button type="button" class="button remove-variant">Xóa</button>
                    </div>
                    <div class="variant-fields">
                        <div>
                            <label>Tên biến thể</label>
                            <input type="text" name="variants[<?php echo $index; ?>][name]" value="<?php echo esc_attr($variant['name'] ?? ''); ?>" placeholder="VD: Màu đen, Size L">
                        </div>
                        <div>
                            <label>SKU</label>
                            <input type="text" name="variants[<?php echo $index; ?>][sku]" value="<?php echo esc_attr($variant['sku'] ?? ''); ?>" placeholder="SKU-001">
                        </div>
                        <div>
                            <label>Giá (VNĐ)</label>
                            <input type="number" name="variants[<?php echo $index; ?>][price]" value="<?php echo esc_attr($variant['price'] ?? ''); ?>" placeholder="0">
                        </div>
                        <div>
                            <label>Số lượng</label>
                            <input type="number" name="variants[<?php echo $index; ?>][stock]" value="<?php echo esc_attr($variant['stock'] ?? ''); ?>" placeholder="0">
                        </div>
                        <div>
                            <label>Hình ảnh</label>
                            <input type="url" name="variants[<?php echo $index; ?>][image]" value="<?php echo esc_url($variant['image'] ?? ''); ?>" placeholder="URL hình ảnh">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="button add-variant">+ Thêm biến thể</button>
    </div>
    <?php
}

function vmst_product_details_callback($post) {
    $price = get_post_meta($post->ID, '_product_price', true);
    $sale_price = get_post_meta($post->ID, '_product_sale_price', true);
    $sku = get_post_meta($post->ID, '_product_sku', true);
    $stock = get_post_meta($post->ID, '_product_stock', true);
    $gallery = get_post_meta($post->ID, '_product_gallery', true);
    $gallery = is_array($gallery) ? $gallery : array();
    ?>
    <table class="form-table">
        <tr>
            <th><label>Giá gốc (VNĐ)</label></th>
            <td><input type="number" name="product_price" value="<?php echo esc_attr($price); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Giá khuyến mãi (VNĐ)</label></th>
            <td><input type="number" name="product_sale_price" value="<?php echo esc_attr($sale_price); ?>" class="regular-text" placeholder="Để trống nếu không có"></td>
        </tr>
        <tr>
            <th><label>SKU</label></th>
            <td><input type="text" name="product_sku" value="<?php echo esc_attr($sku); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Tồn kho</label></th>
            <td><input type="number" name="product_stock" value="<?php echo esc_attr($stock); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Gallery (URLs, mỗi URL một dòng)</label></th>
            <td>
                <textarea name="product_gallery" rows="5" class="large-text" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg"><?php echo esc_textarea(implode("\n", $gallery)); ?></textarea>
                <p class="description">Nhập URL hình ảnh, mỗi URL trên một dòng</p>
            </td>
        </tr>
    </table>
    <?php
}

function vmst_save_product_meta($post_id) {
    if (!isset($_POST['vmst_product_meta_nonce']) || !wp_verify_nonce($_POST['vmst_product_meta_nonce'], 'vmst_product_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Save variants
    if (isset($_POST['variants'])) {
        $variants = array();
        foreach ($_POST['variants'] as $variant) {
            if (!empty($variant['name'])) {
                $variants[] = array(
                    'name' => sanitize_text_field($variant['name']),
                    'sku' => sanitize_text_field($variant['sku'] ?? ''),
                    'price' => floatval($variant['price'] ?? 0),
                    'stock' => intval($variant['stock'] ?? 0),
                    'image' => esc_url_raw($variant['image'] ?? ''),
                );
            }
        }
        update_post_meta($post_id, '_product_variants', $variants);
    }
    
    // Save product details
    if (isset($_POST['product_price'])) {
        update_post_meta($post_id, '_product_price', floatval($_POST['product_price']));
    }
    if (isset($_POST['product_sale_price'])) {
        $sale_price = !empty($_POST['product_sale_price']) ? floatval($_POST['product_sale_price']) : '';
        update_post_meta($post_id, '_product_sale_price', $sale_price);
    }
    if (isset($_POST['product_sku'])) {
        update_post_meta($post_id, '_product_sku', sanitize_text_field($_POST['product_sku']));
    }
    if (isset($_POST['product_stock'])) {
        update_post_meta($post_id, '_product_stock', intval($_POST['product_stock']));
    }
    if (isset($_POST['product_gallery'])) {
        $gallery = array_filter(array_map('trim', explode("\n", $_POST['product_gallery'])));
        $gallery = array_map('esc_url_raw', $gallery);
        update_post_meta($post_id, '_product_gallery', $gallery);
    }
}
add_action('save_post_product', 'vmst_save_product_meta');

/**
 * Add Meta Boxes for Orders
 */
function vmst_add_order_meta_boxes() {
    add_meta_box(
        'order_details',
        'Chi tiết đơn hàng',
        'vmst_order_details_callback',
        'order',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vmst_add_order_meta_boxes');

function vmst_order_details_callback($post) {
    wp_nonce_field('vmst_order_meta', 'vmst_order_meta_nonce');
    $customer_name = get_post_meta($post->ID, '_customer_name', true);
    $customer_email = get_post_meta($post->ID, '_customer_email', true);
    $customer_phone = get_post_meta($post->ID, '_customer_phone', true);
    $order_total = get_post_meta($post->ID, '_order_total', true);
    $order_status = get_post_meta($post->ID, '_order_status', true);
    $order_items = get_post_meta($post->ID, '_order_items', true);
    if (!is_array($order_items)) $order_items = array();
    ?>
    <table class="form-table">
        <tr>
            <th><label>Khách hàng</label></th>
            <td><input type="text" name="customer_name" value="<?php echo esc_attr($customer_name); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Email</label></th>
            <td><input type="email" name="customer_email" value="<?php echo esc_attr($customer_email); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Điện thoại</label></th>
            <td><input type="tel" name="customer_phone" value="<?php echo esc_attr($customer_phone); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Tổng tiền (VNĐ)</label></th>
            <td><input type="number" name="order_total" value="<?php echo esc_attr($order_total); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Trạng thái</label></th>
            <td>
                <select name="order_status" class="regular-text">
                    <option value="pending" <?php selected($order_status, 'pending'); ?>>Chờ xử lý</option>
                    <option value="processing" <?php selected($order_status, 'processing'); ?>>Đang xử lý</option>
                    <option value="completed" <?php selected($order_status, 'completed'); ?>>Hoàn thành</option>
                    <option value="cancelled" <?php selected($order_status, 'cancelled'); ?>>Đã hủy</option>
                </select>
            </td>
        </tr>
    </table>
    <h3>Sản phẩm trong đơn hàng</h3>
    <div class="order-items">
        <?php if (!empty($order_items)) : ?>
            <?php foreach ($order_items as $index => $item) : ?>
                <div class="order-item">
                    <input type="text" name="order_items[<?php echo $index; ?>][name]" value="<?php echo esc_attr($item['name'] ?? ''); ?>" placeholder="Tên sản phẩm" class="regular-text">
                    <input type="number" name="order_items[<?php echo $index; ?>][quantity]" value="<?php echo esc_attr($item['quantity'] ?? 1); ?>" placeholder="Số lượng" min="1">
                    <input type="number" name="order_items[<?php echo $index; ?>][price]" value="<?php echo esc_attr($item['price'] ?? 0); ?>" placeholder="Giá" min="0">
                    <button type="button" class="button remove-order-item">Xóa</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <button type="button" class="button add-order-item">+ Thêm sản phẩm</button>
    <?php
}

function vmst_save_order_meta($post_id) {
    if (!isset($_POST['vmst_order_meta_nonce']) || !wp_verify_nonce($_POST['vmst_order_meta_nonce'], 'vmst_order_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['customer_name'])) {
        update_post_meta($post_id, '_customer_name', sanitize_text_field($_POST['customer_name']));
    }
    if (isset($_POST['customer_email'])) {
        update_post_meta($post_id, '_customer_email', sanitize_email($_POST['customer_email']));
    }
    if (isset($_POST['customer_phone'])) {
        update_post_meta($post_id, '_customer_phone', sanitize_text_field($_POST['customer_phone']));
    }
    if (isset($_POST['order_total'])) {
        update_post_meta($post_id, '_order_total', floatval($_POST['order_total']));
    }
    if (isset($_POST['order_status'])) {
        update_post_meta($post_id, '_order_status', sanitize_text_field($_POST['order_status']));
    }
    if (isset($_POST['order_items'])) {
        $items = array();
        foreach ($_POST['order_items'] as $item) {
            if (!empty($item['name'])) {
                $items[] = array(
                    'name' => sanitize_text_field($item['name']),
                    'quantity' => intval($item['quantity'] ?? 1),
                    'price' => floatval($item['price'] ?? 0),
                );
            }
        }
        update_post_meta($post_id, '_order_items', $items);
    }
}
add_action('save_post_order', 'vmst_save_order_meta');

/**
 * Add Meta Boxes for Customers
 */
function vmst_add_customer_meta_boxes() {
    add_meta_box(
        'customer_details',
        'Thông tin khách hàng',
        'vmst_customer_details_callback',
        'customer',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vmst_add_customer_meta_boxes');

function vmst_customer_details_callback($post) {
    wp_nonce_field('vmst_customer_meta', 'vmst_customer_meta_nonce');
    $email = get_post_meta($post->ID, '_customer_email', true);
    $phone = get_post_meta($post->ID, '_customer_phone', true);
    $address = get_post_meta($post->ID, '_customer_address', true);
    $total_orders = get_post_meta($post->ID, '_total_orders', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label>Email</label></th>
            <td><input type="email" name="customer_email" value="<?php echo esc_attr($email); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Điện thoại</label></th>
            <td><input type="tel" name="customer_phone" value="<?php echo esc_attr($phone); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Địa chỉ</label></th>
            <td><textarea name="customer_address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea></td>
        </tr>
        <tr>
            <th><label>Tổng đơn hàng</label></th>
            <td><input type="number" name="total_orders" value="<?php echo esc_attr($total_orders); ?>" class="regular-text"></td>
        </tr>
    </table>
    <?php
}

function vmst_save_customer_meta($post_id) {
    if (!isset($_POST['vmst_customer_meta_nonce']) || !wp_verify_nonce($_POST['vmst_customer_meta_nonce'], 'vmst_customer_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['customer_email'])) {
        update_post_meta($post_id, '_customer_email', sanitize_email($_POST['customer_email']));
    }
    if (isset($_POST['customer_phone'])) {
        update_post_meta($post_id, '_customer_phone', sanitize_text_field($_POST['customer_phone']));
    }
    if (isset($_POST['customer_address'])) {
        update_post_meta($post_id, '_customer_address', sanitize_textarea_field($_POST['customer_address']));
    }
    if (isset($_POST['total_orders'])) {
        update_post_meta($post_id, '_total_orders', intval($_POST['total_orders']));
    }
}
add_action('save_post_customer', 'vmst_save_customer_meta');

/**
 * Add Custom Columns to Admin Lists
 */

// Products columns
function vmst_product_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = $columns['title'];
    $new_columns['product_sku'] = 'SKU';
    $new_columns['product_price'] = 'Giá';
    $new_columns['product_stock'] = 'Tồn kho';
    $new_columns['product_category'] = 'Danh mục';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_product_posts_columns', 'vmst_product_columns');

function vmst_product_column_content($column, $post_id) {
    switch ($column) {
        case 'product_sku':
            echo esc_html(get_post_meta($post_id, '_product_sku', true));
            break;
        case 'product_price':
            $price = get_post_meta($post_id, '_product_price', true);
            echo $price ? number_format($price, 0, ',', '.') . ' đ' : '-';
            break;
        case 'product_stock':
            $stock = get_post_meta($post_id, '_product_stock', true);
            echo esc_html($stock ?? '-');
            break;
        case 'product_category':
            echo get_the_term_list($post_id, 'product_category', '', ', ', '');
            break;
    }
}
add_action('manage_product_posts_custom_column', 'vmst_product_column_content', 10, 2);

// Orders columns
function vmst_order_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Mã đơn';
    $new_columns['order_customer'] = 'Khách hàng';
    $new_columns['order_total'] = 'Tổng tiền';
    $new_columns['order_status'] = 'Trạng thái';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_order_posts_columns', 'vmst_order_columns');

function vmst_order_column_content($column, $post_id) {
    switch ($column) {
        case 'order_customer':
            echo esc_html(get_post_meta($post_id, '_customer_name', true));
            break;
        case 'order_total':
            $total = get_post_meta($post_id, '_order_total', true);
            echo $total ? number_format($total, 0, ',', '.') . ' đ' : '-';
            break;
        case 'order_status':
            $status = get_post_meta($post_id, '_order_status', true);
            $status_labels = array(
                'pending' => 'Chờ xử lý',
                'processing' => 'Đang xử lý',
                'completed' => 'Hoàn thành',
                'cancelled' => 'Đã hủy',
            );
            echo '<span class="status-badge status-' . esc_attr($status) . '">' . esc_html($status_labels[$status] ?? ucfirst($status)) . '</span>';
            break;
    }
}
add_action('manage_order_posts_custom_column', 'vmst_order_column_content', 10, 2);

// Customers columns
function vmst_customer_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Tên';
    $new_columns['customer_email'] = 'Email';
    $new_columns['customer_phone'] = 'Điện thoại';
    $new_columns['total_orders'] = 'Tổng đơn';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_customer_posts_columns', 'vmst_customer_columns');

function vmst_customer_column_content($column, $post_id) {
    switch ($column) {
        case 'customer_email':
            echo esc_html(get_post_meta($post_id, '_customer_email', true));
            break;
        case 'customer_phone':
            echo esc_html(get_post_meta($post_id, '_customer_phone', true));
            break;
        case 'total_orders':
            echo esc_html(get_post_meta($post_id, '_total_orders', true) ?: '0');
            break;
    }
}
add_action('manage_customer_posts_custom_column', 'vmst_customer_column_content', 10, 2);

// Contact submissions columns
function vmst_contact_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['title'] = 'Tên';
    $new_columns['contact_email'] = 'Email';
    $new_columns['contact_phone'] = 'Điện thoại';
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_contact_submission_posts_columns', 'vmst_contact_columns');

function vmst_contact_column_content($column, $post_id) {
    switch ($column) {
        case 'contact_email':
            echo esc_html(get_post_meta($post_id, '_contact_email', true));
            break;
        case 'contact_phone':
            echo esc_html(get_post_meta($post_id, '_contact_phone', true));
            break;
    }
}
add_action('manage_contact_submission_posts_custom_column', 'vmst_contact_column_content', 10, 2);

/**
 * Add Meta Boxes for Projects
 */
function vmst_add_project_meta_boxes() {
    add_meta_box(
        'project_details',
        'Thông tin dự án',
        'vmst_project_details_callback',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vmst_add_project_meta_boxes');

function vmst_project_details_callback($post) {
    wp_nonce_field('vmst_project_meta', 'vmst_project_meta_nonce');
    $client = get_post_meta($post->ID, '_project_client', true);
    $date = get_post_meta($post->ID, '_project_date', true);
    $location = get_post_meta($post->ID, '_project_location', true);
    $gallery = get_post_meta($post->ID, '_project_gallery', true);
    $gallery = is_array($gallery) ? $gallery : array();
    ?>
    <table class="form-table">
        <tr>
            <th><label>Khách hàng</label></th>
            <td><input type="text" name="project_client" value="<?php echo esc_attr($client); ?>" class="regular-text"></td>
        </tr>
        <tr>
            <th><label>Ngày hoàn thành</label></th>
            <td><input type="text" name="project_date" value="<?php echo esc_attr($date); ?>" class="regular-text" placeholder="VD: 01/2024"></td>
        </tr>
        <tr>
            <th><label>Địa điểm</label></th>
            <td><input type="text" name="project_location" value="<?php echo esc_attr($location); ?>" class="regular-text" placeholder="VD: Hà Nội"></td>
        </tr>
        <tr>
            <th><label>Gallery (URLs, mỗi URL một dòng)</label></th>
            <td>
                <textarea name="project_gallery" rows="5" class="large-text" placeholder="https://example.com/image1.jpg&#10;https://example.com/image2.jpg"><?php echo esc_textarea(implode("\n", $gallery)); ?></textarea>
                <p class="description">Nhập URL hình ảnh, mỗi URL trên một dòng</p>
            </td>
        </tr>
    </table>
    <?php
}

function vmst_save_project_meta($post_id) {
    if (!isset($_POST['vmst_project_meta_nonce']) || !wp_verify_nonce($_POST['vmst_project_meta_nonce'], 'vmst_project_meta')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['project_client'])) {
        update_post_meta($post_id, '_project_client', sanitize_text_field($_POST['project_client']));
    }
    if (isset($_POST['project_date'])) {
        update_post_meta($post_id, '_project_date', sanitize_text_field($_POST['project_date']));
    }
    if (isset($_POST['project_location'])) {
        update_post_meta($post_id, '_project_location', sanitize_text_field($_POST['project_location']));
    }
    if (isset($_POST['project_gallery'])) {
        $gallery = array_filter(array_map('trim', explode("\n", $_POST['project_gallery'])));
        $gallery = array_map('esc_url_raw', $gallery);
        update_post_meta($post_id, '_project_gallery', $gallery);
    }
}
add_action('save_post_project', 'vmst_save_project_meta');

/**
 * Handle Checkout Order Submission
 */
function vmst_submit_order() {
    check_ajax_referer('vmst-nonce', 'nonce');
    
    $order_data = json_decode(stripslashes($_POST['order_data']), true);
    
    if (!$order_data) {
        wp_send_json_error('Invalid order data');
    }
    
    // Create order post
    $order_id = wp_insert_post(array(
        'post_type' => 'order',
        'post_status' => 'publish',
        'post_title' => 'Đơn hàng - ' . $order_data['customer_name'],
    ));
    
    if (is_wp_error($order_id)) {
        wp_send_json_error('Failed to create order');
    }
    
    // Save order meta
    update_post_meta($order_id, '_customer_name', sanitize_text_field($order_data['customer_name']));
    update_post_meta($order_id, '_customer_email', sanitize_email($order_data['customer_email']));
    update_post_meta($order_id, '_customer_phone', sanitize_text_field($order_data['customer_phone']));
    update_post_meta($order_id, '_customer_city', sanitize_text_field($order_data['customer_city']));
    update_post_meta($order_id, '_customer_address', sanitize_text_field($order_data['customer_address']));
    update_post_meta($order_id, '_customer_note', sanitize_textarea_field($order_data['customer_note'] ?? ''));
    update_post_meta($order_id, '_payment_method', sanitize_text_field($order_data['payment_method']));
    update_post_meta($order_id, '_order_total', floatval($order_data['total']));
    update_post_meta($order_id, '_order_status', 'pending');
    update_post_meta($order_id, '_order_items', $order_data['items']);
    
    wp_send_json_success(array('order_id' => $order_id));
}
add_action('wp_ajax_vmst_submit_order', 'vmst_submit_order');
add_action('wp_ajax_nopriv_vmst_submit_order', 'vmst_submit_order');

/**
 * Get Product Data for Cart (AJAX)
 */
function vmst_get_product_data() {
    // Support both GET and POST
    $product_id = isset($_REQUEST['product_id']) ? intval($_REQUEST['product_id']) : 0;
    
    if (!$product_id) {
        wp_send_json_error('Invalid product ID');
    }
    
    $product = get_post($product_id);
    if (!$product || $product->post_type !== 'product' || $product->post_status !== 'publish') {
        wp_send_json_error('Product not found');
    }
    
    $price = get_post_meta($product_id, '_product_price', true);
    $sale_price = get_post_meta($product_id, '_product_sale_price', true);
    $sku = get_post_meta($product_id, '_product_sku', true);
    $stock = get_post_meta($product_id, '_product_stock', true);
    
    // Get featured image
    $image = '';
    if (has_post_thumbnail($product_id)) {
        $image = get_the_post_thumbnail_url($product_id, 'medium');
    }
    if (!$image) {
        $image = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400';
    }
    
    // Determine final price
    $final_price = 0;
    if ($sale_price && floatval($sale_price) > 0) {
        $final_price = floatval($sale_price);
    } elseif ($price && floatval($price) > 0) {
        $final_price = floatval($price);
    }
    
    wp_send_json_success(array(
        'id' => $product_id,
        'title' => get_the_title($product_id),
        'price' => $final_price,
        'original_price' => floatval($price ?: 0),
        'sale_price' => floatval($sale_price ?: 0),
        'sku' => $sku,
        'stock' => intval($stock ?: 0),
        'image' => $image,
        'permalink' => get_permalink($product_id),
    ));
}
add_action('wp_ajax_vmst_get_product_data', 'vmst_get_product_data');
add_action('wp_ajax_nopriv_vmst_get_product_data', 'vmst_get_product_data');

/**
 * Get Multiple Products Data (AJAX) - For Cart/Checkout
 */
function vmst_get_products_data() {
    $product_ids = isset($_REQUEST['product_ids']) ? $_REQUEST['product_ids'] : array();
    
    if (is_string($product_ids)) {
        $product_ids = json_decode(stripslashes($product_ids), true);
    }
    
    if (!is_array($product_ids) || empty($product_ids)) {
        wp_send_json_error('Invalid product IDs');
    }
    
    $products = array();
    
    foreach ($product_ids as $product_id) {
        $product_id = intval($product_id);
        if (!$product_id) continue;
        
        $product = get_post($product_id);
        if (!$product || $product->post_type !== 'product' || $product->post_status !== 'publish') {
            continue;
        }
        
        $price = get_post_meta($product_id, '_product_price', true);
        $sale_price = get_post_meta($product_id, '_product_sale_price', true);
        $sku = get_post_meta($product_id, '_product_sku', true);
        $stock = get_post_meta($product_id, '_product_stock', true);
        
        // Get featured image
        $image = '';
        if (has_post_thumbnail($product_id)) {
            $image = get_the_post_thumbnail_url($product_id, 'medium');
        }
        if (!$image) {
            $image = 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=400';
        }
        
        // Determine final price
        $final_price = 0;
        if ($sale_price && floatval($sale_price) > 0) {
            $final_price = floatval($sale_price);
        } elseif ($price && floatval($price) > 0) {
            $final_price = floatval($price);
        }
        
        $products[$product_id] = array(
            'id' => $product_id,
            'title' => get_the_title($product_id),
            'price' => $final_price,
            'original_price' => floatval($price ?: 0),
            'sale_price' => floatval($sale_price ?: 0),
            'sku' => $sku,
            'stock' => intval($stock ?: 0),
            'image' => $image,
            'permalink' => get_permalink($product_id),
        );
    }
    
    wp_send_json_success($products);
}
add_action('wp_ajax_vmst_get_products_data', 'vmst_get_products_data');
add_action('wp_ajax_nopriv_vmst_get_products_data', 'vmst_get_products_data');



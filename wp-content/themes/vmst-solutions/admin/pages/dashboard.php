<?php
/**
 * Dashboard Tổng quan
 */

if (!current_user_can('manage_options')) {
    wp_die(__('Bạn không có quyền truy cập trang này.'));
}

// Get statistics
$products_count = wp_count_posts('product');
$projects_count = wp_count_posts('project');
$orders_count = wp_count_posts('order');
$customers_count = wp_count_posts('customer');
$contacts_count = wp_count_posts('contact_submission');
$posts_count = wp_count_posts('post');
$pages_count = wp_count_posts('page');

// Recent orders
$recent_orders = get_posts(array(
    'post_type' => 'order',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
));

// Recent contacts
$recent_contacts = get_posts(array(
    'post_type' => 'contact_submission',
    'posts_per_page' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
));
?>

<div class="wrap namin-dashboard">
    <h1 class="wp-heading-inline">Dashboard Tổng quan</h1>
    
    <div class="namin-stats-grid">
        <div class="namin-stat-card">
            <div class="stat-icon products">
                <span class="dashicons dashicons-cart"></span>
            </div>
            <div class="stat-content">
                <h3><?php echo $products_count->publish ?? 0; ?></h3>
                <p>Sản phẩm</p>
                <a href="<?php echo admin_url('edit.php?post_type=product'); ?>" class="stat-link">Xem tất cả →</a>
            </div>
        </div>
        
        <div class="namin-stat-card">
            <div class="stat-icon projects">
                <span class="dashicons dashicons-portfolio"></span>
            </div>
            <div class="stat-content">
                <h3><?php echo $projects_count->publish ?? 0; ?></h3>
                <p>Dự án</p>
                <a href="<?php echo admin_url('edit.php?post_type=project'); ?>" class="stat-link">Xem tất cả →</a>
            </div>
        </div>
        
        <div class="namin-stat-card">
            <div class="stat-icon orders">
                <span class="dashicons dashicons-clipboard"></span>
            </div>
            <div class="stat-content">
                <h3><?php echo $orders_count->publish ?? 0; ?></h3>
                <p>Đơn hàng</p>
                <a href="<?php echo admin_url('edit.php?post_type=order'); ?>" class="stat-link">Xem tất cả →</a>
            </div>
        </div>
        
        <div class="namin-stat-card">
            <div class="stat-icon customers">
                <span class="dashicons dashicons-groups"></span>
            </div>
            <div class="stat-content">
                <h3><?php echo $customers_count->publish ?? 0; ?></h3>
                <p>Khách hàng</p>
                <a href="<?php echo admin_url('edit.php?post_type=customer'); ?>" class="stat-link">Xem tất cả →</a>
            </div>
        </div>
        
        <div class="namin-stat-card">
            <div class="stat-icon contacts">
                <span class="dashicons dashicons-email-alt"></span>
            </div>
            <div class="stat-content">
                <h3><?php echo $contacts_count->publish ?? 0; ?></h3>
                <p>Form Liên hệ</p>
                <a href="<?php echo admin_url('edit.php?post_type=contact_submission'); ?>" class="stat-link">Xem tất cả →</a>
            </div>
        </div>
        
        <div class="namin-stat-card">
            <div class="stat-icon posts">
                <span class="dashicons dashicons-admin-post"></span>
            </div>
            <div class="stat-content">
                <h3><?php echo ($posts_count->publish ?? 0) + ($pages_count->publish ?? 0); ?></h3>
                <p>Bài viết & Trang</p>
                <a href="<?php echo admin_url('admin.php?page=namin-posts-pages'); ?>" class="stat-link">Xem tất cả →</a>
            </div>
        </div>
    </div>
    
    <div class="namin-dashboard-content">
        <div class="namin-dashboard-column">
            <div class="namin-widget">
                <h2>Đơn hàng gần đây</h2>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Khách hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_orders)) : ?>
                            <?php foreach ($recent_orders as $order) : 
                                $order_meta = get_post_meta($order->ID);
                                $customer_name = $order_meta['_customer_name'][0] ?? 'N/A';
                                $total = $order_meta['_order_total'][0] ?? '0';
                                $status = $order_meta['_order_status'][0] ?? 'pending';
                            ?>
                                <tr>
                                    <td><a href="<?php echo get_edit_post_link($order->ID); ?>">#<?php echo $order->ID; ?></a></td>
                                    <td><?php echo esc_html($customer_name); ?></td>
                                    <td><?php echo number_format($total, 0, ',', '.'); ?> đ</td>
                                    <td><span class="status-badge status-<?php echo esc_attr($status); ?>"><?php echo esc_html(ucfirst($status)); ?></span></td>
                                    <td><?php echo get_the_date('d/m/Y', $order->ID); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">Chưa có đơn hàng nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="namin-dashboard-column">
            <div class="namin-widget">
                <h2>Liên hệ gần đây</h2>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Điện thoại</th>
                            <th>Ngày</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($recent_contacts)) : ?>
                            <?php foreach ($recent_contacts as $contact) : 
                                $contact_meta = get_post_meta($contact->ID);
                                $email = $contact_meta['_contact_email'][0] ?? '';
                                $phone = $contact_meta['_contact_phone'][0] ?? '';
                            ?>
                                <tr>
                                    <td><a href="<?php echo get_edit_post_link($contact->ID); ?>"><?php echo esc_html($contact->post_title); ?></a></td>
                                    <td><?php echo esc_html($email); ?></td>
                                    <td><?php echo esc_html($phone); ?></td>
                                    <td><?php echo get_the_date('d/m/Y', $contact->ID); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4">Chưa có liên hệ nào</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


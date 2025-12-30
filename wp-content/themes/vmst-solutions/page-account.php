<?php
/**
 * Template Name: Account Page
 * User Account Dashboard
 */

get_header();

// Get current user orders
$user_email = isset($_GET['email']) ? sanitize_email($_GET['email']) : '';
$order_id = isset($_GET['order']) ? intval($_GET['order']) : 0;
?>

<main id="main-content" class="site-main">
    <div class="account-page">
        <div class="container">
            <h1 class="account-title">Tài khoản của tôi</h1>
            
            <?php if ($order_id) : ?>
                <div class="order-success">
                    <div class="success-icon">✓</div>
                    <h2>Đặt hàng thành công!</h2>
                    <p>Mã đơn hàng của bạn: <strong>#<?php echo $order_id; ?></strong></p>
                    <p>Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.</p>
                </div>
            <?php endif; ?>
            
            <div class="account-tabs">
                <button class="tab-btn active" onclick="switchTab('orders')">Đơn hàng</button>
                <button class="tab-btn" onclick="switchTab('profile')">Thông tin</button>
            </div>
            
            <div id="orders-tab" class="tab-content active">
                <div class="orders-section">
                    <h2 class="section-title">Lịch sử đơn hàng</h2>
                    
                    <?php if ($user_email) : ?>
                        <?php
                        $orders = get_posts(array(
                            'post_type' => 'order',
                            'posts_per_page' => -1,
                            'meta_query' => array(
                                array(
                                    'key' => '_customer_email',
                                    'value' => $user_email,
                                    'compare' => '='
                                )
                            ),
                            'orderby' => 'date',
                            'order' => 'DESC'
                        ));
                        ?>
                        
                        <?php if ($orders) : ?>
                            <div class="orders-list">
                                <?php foreach ($orders as $order) : 
                                    $order_meta = get_post_meta($order->ID);
                                    $status = $order_meta['_order_status'][0] ?? 'pending';
                                    $total = $order_meta['_order_total'][0] ?? 0;
                                ?>
                                    <div class="order-card">
                                        <div class="order-header">
                                            <div>
                                                <h3>Đơn hàng #<?php echo $order->ID; ?></h3>
                                                <p class="order-date"><?php echo get_the_date('d/m/Y H:i', $order->ID); ?></p>
                                            </div>
                                            <span class="order-status status-<?php echo esc_attr($status); ?>">
                                                <?php
                                                $status_labels = array(
                                                    'pending' => 'Chờ xử lý',
                                                    'processing' => 'Đang xử lý',
                                                    'completed' => 'Hoàn thành',
                                                    'cancelled' => 'Đã hủy'
                                                );
                                                echo $status_labels[$status] ?? ucfirst($status);
                                                ?>
                                            </span>
                                        </div>
                                        <div class="order-body">
                                            <div class="order-total">
                                                <strong>Tổng tiền:</strong> <?php echo number_format($total, 0, ',', '.'); ?> đ
                                            </div>
                                            <a href="?order_detail=<?php echo $order->ID; ?>" class="view-order-btn">Xem chi tiết</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <div class="no-orders">
                                <p>Bạn chưa có đơn hàng nào.</p>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="lookup-form">
                            <p>Nhập email để xem đơn hàng của bạn:</p>
                            <form method="get" class="email-lookup">
                                <input type="hidden" name="page_id" value="<?php echo get_the_ID(); ?>">
                                <input type="email" name="email" placeholder="Email của bạn" required>
                                <button type="submit">Tìm kiếm</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div id="profile-tab" class="tab-content">
                <div class="profile-section">
                    <h2 class="section-title">Thông tin tài khoản</h2>
                    <div class="profile-info">
                        <p>Để quản lý thông tin tài khoản, vui lòng đăng nhập vào hệ thống.</p>
                        <a href="<?php echo wp_login_url(); ?>" class="login-btn">Đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
    });
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    document.getElementById(tab + '-tab').classList.add('active');
    event.target.classList.add('active');
}
</script>

<style>
.account-page {
    padding-top: 100px;
    padding-bottom: 80px;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 20px;
}

.account-title {
    font-size: 36px;
    font-weight: 700;
    margin-bottom: 40px;
    text-align: center;
}

.order-success {
    background: linear-gradient(135deg, #d1e7dd 0%, #a3cfbb 100%);
    padding: 40px;
    border-radius: 12px;
    text-align: center;
    margin-bottom: 40px;
}

.success-icon {
    width: 80px;
    height: 80px;
    background: #28a745;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    margin: 0 auto 20px;
}

.order-success h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: #155724;
}

.order-success p {
    font-size: 16px;
    color: #155724;
    margin-bottom: 10px;
}

.account-tabs {
    display: flex;
    gap: 10px;
    margin-bottom: 30px;
    border-bottom: 2px solid #e9ecef;
}

.tab-btn {
    padding: 15px 30px;
    background: none;
    border: none;
    border-bottom: 3px solid transparent;
    font-size: 16px;
    font-weight: 600;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-bottom: -2px;
}

.tab-btn:hover,
.tab-btn.active {
    color: #087bb5;
    border-bottom-color: #087bb5;
}

.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

.section-title {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 30px;
}

.orders-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.order-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid #e9ecef;
}

.order-header h3 {
    font-size: 20px;
    margin-bottom: 5px;
}

.order-date {
    color: #666;
    font-size: 14px;
}

.order-status {
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.order-status.status-pending {
    background: #fff3cd;
    color: #856404;
}

.order-status.status-processing {
    background: #cfe2ff;
    color: #084298;
}

.order-status.status-completed {
    background: #d1e7dd;
    color: #0f5132;
}

.order-status.status-cancelled {
    background: #f8d7da;
    color: #842029;
}

.order-body {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.order-total {
    font-size: 18px;
    color: #087bb5;
}

.view-order-btn {
    padding: 10px 20px;
    background: #087bb5;
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: background 0.3s ease;
}

.view-order-btn:hover {
    background: #065a87;
}

.no-orders,
.lookup-form {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.email-lookup {
    display: flex;
    gap: 10px;
    max-width: 500px;
    margin: 20px auto 0;
}

.email-lookup input {
    flex: 1;
    padding: 12px 15px;
    border: 2px solid #e9ecef;
    border-radius: 8px;
    font-size: 16px;
}

.email-lookup button {
    padding: 12px 30px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
}

.profile-section {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    text-align: center;
}

.profile-info p {
    margin-bottom: 20px;
    color: #666;
}

.login-btn {
    display: inline-block;
    padding: 12px 30px;
    background: linear-gradient(135deg, #087bb5 0%, #00f2fe 100%);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
}
</style>

<?php
get_footer();
?>


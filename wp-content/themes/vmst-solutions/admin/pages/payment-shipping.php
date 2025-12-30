<?php
/**
 * Quản lý Thanh toán & Vận chuyển
 */

if (!current_user_can('manage_options')) {
    wp_die(__('Bạn không có quyền truy cập trang này.'));
}

// Handle form submission
if (isset($_POST['save_payment_shipping']) && check_admin_referer('vmst_payment_shipping')) {
    update_option('vmst_payment_methods', sanitize_textarea_field($_POST['payment_methods']));
    update_option('vmst_shipping_methods', sanitize_textarea_field($_POST['shipping_methods']));
    update_option('vmst_shipping_zones', sanitize_textarea_field($_POST['shipping_zones']));
    echo '<div class="notice notice-success"><p>Cài đặt đã được lưu!</p></div>';
}

$payment_methods = get_option('vmst_payment_methods', '');
$shipping_methods = get_option('vmst_shipping_methods', '');
$shipping_zones = get_option('vmst_shipping_zones', '');
?>

<div class="wrap namin-payment-shipping">
    <h1>Quản lý Thanh toán & Vận chuyển</h1>
    
    <form method="post" action="">
        <?php wp_nonce_field('vmst_payment_shipping'); ?>
        
        <div class="namin-settings-section">
            <h2>Phương thức thanh toán</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label>Danh sách phương thức thanh toán</label>
                    </th>
                    <td>
                        <textarea name="payment_methods" rows="10" class="large-text"><?php echo esc_textarea($payment_methods); ?></textarea>
                        <p class="description">Mỗi phương thức thanh toán trên một dòng. Ví dụ:<br>
                        - Chuyển khoản ngân hàng<br>
                        - Thanh toán khi nhận hàng (COD)<br>
                        - Ví điện tử (MoMo, ZaloPay, VNPay)</p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="namin-settings-section">
            <h2>Phương thức vận chuyển</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label>Danh sách phương thức vận chuyển</label>
                    </th>
                    <td>
                        <textarea name="shipping_methods" rows="10" class="large-text"><?php echo esc_textarea($shipping_methods); ?></textarea>
                        <p class="description">Mỗi phương thức vận chuyển trên một dòng. Ví dụ:<br>
                        - Giao hàng nhanh (1-2 ngày)<br>
                        - Giao hàng tiêu chuẩn (3-5 ngày)<br>
                        - Giao hàng tiết kiệm (5-7 ngày)</p>
                    </td>
                </tr>
            </table>
        </div>
        
        <div class="namin-settings-section">
            <h2>Khu vực vận chuyển</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label>Danh sách khu vực</label>
                    </th>
                    <td>
                        <textarea name="shipping_zones" rows="10" class="large-text"><?php echo esc_textarea($shipping_zones); ?></textarea>
                        <p class="description">Mỗi khu vực trên một dòng. Ví dụ:<br>
                        - Nội thành Hà Nội: 30,000 đ<br>
                        - Ngoại thành Hà Nội: 50,000 đ<br>
                        - Toàn quốc: 80,000 đ</p>
                    </td>
                </tr>
            </table>
        </div>
        
        <p class="submit">
            <input type="submit" name="save_payment_shipping" class="button button-primary" value="Lưu cài đặt">
        </p>
    </form>
</div>


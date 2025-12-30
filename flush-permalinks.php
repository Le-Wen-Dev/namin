<?php
/**
 * Flush Permalinks - Run this once via browser
 * URL: http://namin.local/flush-permalinks.php
 */

require_once('wp-load.php');

// Flush rewrite rules
flush_rewrite_rules();

echo '<h1 style="text-align: center; padding: 50px; font-family: Arial;">✅ Permalinks đã được flush thành công!</h1>';
echo '<p style="text-align: center; font-size: 18px;">Bây giờ bạn có thể:</p>';
echo '<ul style="max-width: 600px; margin: 20px auto; font-size: 16px;">';
echo '<li>Xem sản phẩm tại: <a href="' . home_url('/san-pham') . '">' . home_url('/san-pham') . '</a></li>';
echo '<li>Vào Admin → Settings → Permalinks → Click "Save Changes" (không cần thay đổi gì)</li>';
echo '</ul>';
echo '<p style="text-align: center; margin-top: 30px;"><a href="' . home_url() . '" style="padding: 10px 20px; background: #087bb5; color: white; text-decoration: none; border-radius: 5px;">Về trang chủ</a></p>';


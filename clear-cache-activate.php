<?php
/**
 * Clear all caches and ensure theme is active
 */
require_once(__DIR__ . '/wp-load.php');

// Force activate theme
switch_theme('vmst-solutions');

// Clear all caches
wp_cache_flush();
if (function_exists('wp_cache_delete')) {
    wp_cache_delete('themes', 'themes');
}

// Clear object cache
if (function_exists('wp_cache_flush_group')) {
    wp_cache_flush_group('themes');
}

// Update theme mods
$theme = wp_get_theme('vmst-solutions');
if ($theme->exists()) {
    update_option('stylesheet', 'vmst-solutions');
    update_option('template', 'vmst-solutions');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Theme Activated - Clear Cache</title>
    <meta http-equiv="refresh" content="3;url=<?php echo home_url(); ?>">
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            max-width: 600px;
            margin: 100px auto;
            padding: 40px;
            text-align: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .box {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .success {
            color: #4CAF50;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .info {
            color: #666;
            margin: 20px 0;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 24px;
            background: #087bb5;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="success">✅ Theme Activated & Cache Cleared!</div>
        <div class="info">
            <p><strong>VMST Solutions</strong> theme is now active.</p>
            <p>Redirecting to your website in 3 seconds...</p>
            <p><small>If you still see old content, please:</small></p>
            <ul style="text-align: left; display: inline-block;">
                <li>Hard refresh: <strong>Cmd+Shift+R</strong> (Mac) or <strong>Ctrl+Shift+R</strong> (Windows)</li>
                <li>Clear browser cache</li>
                <li>Try incognito/private mode</li>
            </ul>
        </div>
        <div>
            <a href="<?php echo home_url(); ?>">View Website Now</a>
            <a href="<?php echo admin_url('themes.php'); ?>">Go to Themes</a>
        </div>
    </div>
</body>
</html>


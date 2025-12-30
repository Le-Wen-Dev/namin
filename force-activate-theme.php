<?php
/**
 * Force activate VMST Solutions theme
 * Run this directly
 */

// Load WordPress
require_once(__DIR__ . '/wp-load.php');

// Get database connection
global $wpdb;

$theme_slug = 'vmst-solutions';

// Check if theme exists
$theme_path = __DIR__ . '/wp-content/themes/' . $theme_slug;
if (!file_exists($theme_path)) {
    die("❌ Theme not found at: $theme_path\n");
}

// Check if style.css exists
if (!file_exists($theme_path . '/style.css')) {
    die("❌ Theme style.css not found!\n");
}

// Force activate via database
$wpdb->update(
    $wpdb->options,
    array('option_value' => $theme_slug),
    array('option_name' => 'stylesheet')
);

$wpdb->update(
    $wpdb->options,
    array('option_value' => $theme_slug),
    array('option_name' => 'template')
);

// Clear cache
wp_cache_flush();

echo "✅ Theme 'VMST Solutions' has been activated!\n";
echo "🌐 Visit: " . home_url() . "\n";
echo "📝 Admin: " . admin_url('themes.php') . "\n";

// If accessed via browser
if (php_sapi_name() !== 'cli') {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Theme Activated</title>
        <meta http-equiv="refresh" content="2;url=<?php echo home_url(); ?>">
        <style>
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
                max-width: 600px;
                margin: 100px auto;
                padding: 40px;
                text-align: center;
                background: #f5f5f5;
            }
            .success {
                background: #4CAF50;
                color: white;
                padding: 30px;
                border-radius: 8px;
                margin-bottom: 20px;
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
        <div class="success">
            <h2>✅ Theme Activated!</h2>
            <p>Redirecting to your website...</p>
        </div>
        <a href="<?php echo home_url(); ?>">View Website Now</a>
        <a href="<?php echo admin_url('themes.php'); ?>">Go to Themes</a>
    </body>
    </html>
    <?php
}


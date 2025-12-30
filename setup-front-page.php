<?php
/**
 * Setup front page to use front-page.php template
 */
require_once(__DIR__ . '/wp-load.php');

// Ensure theme is active
switch_theme('vmst-solutions');

// Create a front page if it doesn't exist
$front_page = get_page_by_path('home');
if (!$front_page) {
    $front_page_id = wp_insert_post(array(
        'post_title' => 'Home',
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'home'
    ));
} else {
    $front_page_id = $front_page->ID;
}

// Set as front page
update_option('show_on_front', 'page');
update_option('page_on_front', $front_page_id);

// Clear cache
wp_cache_flush();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Front Page Setup</title>
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
        }
    </style>
</head>
<body>
    <div class="success">
        <h2>✅ Front Page Setup Complete!</h2>
        <p>Redirecting to your website...</p>
    </div>
    <a href="<?php echo home_url(); ?>" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: #087bb5; color: white; text-decoration: none; border-radius: 4px;">View Website</a>
</body>
</html>


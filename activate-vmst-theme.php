<?php
/**
 * Script to activate VMST Solutions theme
 * Access via browser: http://yoursite.com/activate-vmst-theme.php?activate=1
 * Then DELETE this file for security!
 */

// Load WordPress
require_once(__DIR__ . '/wp-load.php');

// Security check - require activation parameter
if (!isset($_GET['activate']) || $_GET['activate'] !== '1') {
    die('⚠️ Add ?activate=1 to the URL to activate the theme.<br>Example: activate-vmst-theme.php?activate=1');
}

$theme_slug = 'vmst-solutions';

// Check if theme exists
$theme = wp_get_theme($theme_slug);
if (!$theme->exists()) {
    die('❌ Error: Theme "vmst-solutions" not found in wp-content/themes/');
}

// Activate the theme
switch_theme($theme->get_stylesheet());

?>
<!DOCTYPE html>
<html>
<head>
    <title>Theme Activated</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            max-width: 600px;
            margin: 100px auto;
            padding: 40px;
            background: #f5f5f5;
        }
        .success {
            background: #4CAF50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .warning {
            background: #ff9800;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            margin: 10px 10px 10px 0;
            padding: 12px 24px;
            background: #087bb5;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background: #066a9a;
        }
    </style>
</head>
<body>
    <div class="success">
        <h2>✅ Theme Activated Successfully!</h2>
        <p><strong>VMST Solutions</strong> theme is now active on your website.</p>
    </div>
    
    <div class="warning">
        <h3>⚠️ Important Security Step</h3>
        <p>Please <strong>DELETE</strong> this file (<code>activate-vmst-theme.php</code>) immediately for security!</p>
    </div>
    
    <div>
        <a href="<?php echo home_url(); ?>">View Website</a>
        <a href="<?php echo admin_url('themes.php'); ?>">Go to Themes</a>
        <a href="<?php echo admin_url('customize.php'); ?>">Customize Theme</a>
    </div>
    
    <hr style="margin: 40px 0;">
    <p style="color: #666; font-size: 14px;">
        <strong>Next steps:</strong><br>
        1. Visit your website to see the new theme<br>
        2. Go to Appearance > Menus to set up navigation<br>
        3. Go to Appearance > Customize to customize the theme<br>
        4. <strong>Delete this activation file!</strong>
    </p>
</body>
</html>

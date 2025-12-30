<?php
/**
 * Check current active theme
 */
require_once(__DIR__ . '/wp-load.php');

$current_theme = wp_get_theme();
$active_stylesheet = get_option('stylesheet');
$active_template = get_option('template');

echo "Current Theme: " . $current_theme->get('Name') . "\n";
echo "Stylesheet: " . $active_stylesheet . "\n";
echo "Template: " . $active_template . "\n";
echo "Theme Path: " . $current_theme->get_stylesheet_directory() . "\n";

if ($active_stylesheet === 'vmst-solutions') {
    echo "✅ VMST Solutions is active!\n";
} else {
    echo "❌ VMST Solutions is NOT active. Current: $active_stylesheet\n";
    echo "Trying to activate...\n";
    switch_theme('vmst-solutions');
    echo "✅ Activated!\n";
}

if (php_sapi_name() !== 'cli') {
    echo "<br><a href='" . home_url() . "'>View Site</a>";
}


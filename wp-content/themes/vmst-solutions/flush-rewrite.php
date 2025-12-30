<?php
/**
 * Flush Rewrite Rules
 * Access this file once via browser to flush rewrite rules
 */

require_once('../../../wp-load.php');

flush_rewrite_rules();

echo '<h1>Rewrite rules flushed successfully!</h1>';
echo '<p>You can now close this page.</p>';
echo '<p><a href="' . home_url() . '">Go to homepage</a></p>';


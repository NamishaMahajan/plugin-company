<?php
/* 
Plugin Name: Company Information
Description: This is my first 
Version: 1.0 
Author: Namisha
Text Domain: company_info 
*/

define('CM_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MY_PLUGIN_DIR', plugin_dir_path(__FILE__));
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

require plugin_dir_path(__FILE__) . 'multi-step-form.php';
require plugin_dir_path(__FILE__) . '/includes/scripts.php';
require plugin_dir_path(__FILE__) . '/includes/shortcode.php';
require plugin_dir_path(__FILE__) . '/includes/shortcode.php';

// Function to create the table
function my_plugin_create_table() {
    global $wpdb;

    // Set the table name with the prefix
    $table_name = $wpdb->prefix . 'company_info';

    // SQL query to create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Include the WordPress file to execute the dbDelta function
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // Execute the query
    dbDelta($sql);
}

// Hook the function to the plugin activation event
register_activation_hook(__FILE__, 'my_plugin_create_table');
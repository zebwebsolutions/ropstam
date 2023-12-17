<?php

/*
 * Plugin Name:       Websites Source Code Plugin
 * Plugin URI:        https://ropstam.com
 * Description:       Get the Source Code of any website
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            Rahman Zeb
 * Author URI:        https://rahmanzeb.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

 // Ensure this file is only executed within the WordPress environment
if (!defined('ABSPATH')) {
    exit;
}

// Include the main plugin class
require_once(plugin_dir_path(__FILE__) . 'includes/class-websites-sc-plugin.php');

// Instantiate the main class
$custom_website_plugin = new Websites_Sc_Plugin();
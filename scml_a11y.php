<?php
namespace SCML\A11Y;
/**
 * Plugin Name: WP-A11Y Plugin
 * Plugin URI: https://github.com/matias2018/a11y
 * Description: This is a plugin to manage accessibility issues.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author: Pedro Matias @ UACOR SCML
 * Author URI: https://pedromatias.dev
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       scml-a11y
 * Domain Path:       /languages/
 */

/* !!! comment in production !!! */
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// If this file is called directly, abort.
if (!defined('WPINC')) {
  die;
}

// Add a hook to run the deinitialization function when the plugin is deactivated
register_deactivation_hook(__FILE__, 'SCML\A11Y\scml_a11y_plugin_deactivate');

// Function to perform cleanup tasks on plugin deactivation
function scml_a11y_plugin_deactivate()
{
  error_log('SCML A11Y Plugin deactivated successfully!');
  flush_rewrite_rules();
}

// Add a settings link to the plugin page
function scml_a11y_plugin_settings_link($links)
{
  $settings_link = '<a href="options-general.php?page=a11y-banner-settings">' . __('Settings') . '</a>';
  array_unshift($links, $settings_link);
  return $links;
}

include_once(plugin_dir_path(__FILE__) . 'enqueue_scripts.php');
include_once(plugin_dir_path(__FILE__) . 'inc/display_a11y_banner.php');

function initialization()
{
  static $initialized = false;

  if ($initialized) {
    return;
  }
  // error_log('SCML A11Y Plugin initialized successfully!');
  $initialized = true;
}

// Hooking functions
add_action('init', 'SCML\A11Y\initialization');
add_action('wp_enqueue_scripts', 'SCML\A11Y\enqueue_accessibility_scripts');

// Hook banner display to the footer
add_action('wp_footer', 'display_a11y_banner');
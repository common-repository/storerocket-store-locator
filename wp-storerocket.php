<?php

/**
 * @package WPStoreRocket
 */

/*
Plugin Name: StoreRocket Store Locator
Plugin URI: https://storerocket.io/wordpress-store-locator
Description: Add the first-in-class modern StoreRocket Store Locator to your WordPress website.
Author: StoreRocket
Author URI: https://storerocket.io
Version: 1.0.0
Text Domain: wp-storerocket
*/

use WPStoreRocket\Init;
use WPStoreRocket\Deactivate;

// Exits if the file is accessed directly.
if ( ! defined('ABSPATH')) {
    exit;
}

wp_storerocket_define_constants();

/**
 * Initialize the plugin.
 */
function wp_storerocket_init()
{
    require_once(WP_STOREROCKET_INC_DIR . 'init.class.php');
    new Init();
}

add_action('after_setup_theme', 'wp_storerocket_init');

/**
 * Show a notice if the account ID is not configured.
 */
function wp_storerocket_show_settings_notice()
{
    $account_id = get_option('wp_storerocket_id');

    if (empty($account_id)) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p>
                <b>StoreRocket</b> - Please configure your account ID in the
                <a href="<?php echo admin_url('admin.php?page=wp_storerocket_settings') ?>">Settings page</a>
                in order to be able to add the store locator.</p>
        </div>
        <?php
    }
}

add_action('admin_notices', 'wp_storerocket_show_settings_notice');

/**
 * Items to perform on plugin activation.
 *
 * Check that PHP version is at least 5.2.4.
 */
function wp_storerocket_do_activation()
{
    $minPhpVersion = '5.2.4';

    if (defined('PHP_VERSION') && version_compare(PHP_VERSION, $minPhpVersion, '<=')) {
        $notice = '<strong style="font-size: 22px;">%s</strong><hr>';
        $notice .= 'The StoreRocket plugin must be running on a server with <strong>PHP version 5.4 or higher</strong> installed to work correctly. Your server is currently running <strong>%s</strong>. Please consider upgrading your PHP to a newer version.';
        $notice .= '<p><a href="/wp-admin/plugins.php">&larr; Back to Plugins</a></p>';
        $notice = sprintf($notice, 'PHP Version Notice :(', PHP_VERSION);
        wp_die($notice);
    }
}

register_activation_hook(__FILE__, 'wp_storerocket_do_activation');

/**
 * Items to perform on plugin deactivation.
 */
function wp_storerocket_do_deactivation()
{
    require_once(WP_STOREROCKET_INC_DIR . 'deactivate.class.php');
    new Deactivate();
}

register_deactivation_hook(__FILE__, 'wp_storerocket_do_deactivation');

/**
 * Setup constants throughout the plugin.
 */
function wp_storerocket_define_constants()
{
    if ( ! defined('WP_STOREROCKET_FILE')) {
        define('WP_STOREROCKET_FILE', __FILE__);
    }

    if ( ! defined('WP_STOREROCKET_NAME')) {
        define('WP_STOREROCKET_NAME', plugin_basename(WP_STOREROCKET_FILE));
    }

    if ( ! defined('WP_STOREROCKET_DIR')) {
        define('WP_STOREROCKET_DIR', trailingslashit(plugin_dir_path(WP_STOREROCKET_FILE)));
    }

    if ( ! defined('WP_STOREROCKET_DIR_URL')) {
        define('WP_STOREROCKET_DIR_URL', trailingslashit(plugin_dir_url(WP_STOREROCKET_FILE)));
    }

    if ( ! defined('WP_STOREROCKET_INC_DIR')) {
        define('WP_STOREROCKET_INC_DIR', trailingslashit(WP_STOREROCKET_DIR . 'includes'));
    }

    if ( ! defined('WP_STOREROCKET_TEMPLATE_DIR')) {
        define('WP_STOREROCKET_TEMPLATE_DIR', trailingslashit(WP_STOREROCKET_INC_DIR . 'templates'));
    }
}
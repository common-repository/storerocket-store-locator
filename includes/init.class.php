<?php

namespace WPStoreRocket;

/**
 * Class Init.
 *
 * Initialize the plugin and its classes.
 *
 * @package WPStoreRocket
 */
class Init
{

    /**
     * Init constructor.
     */
    public function __construct()
    {
        add_action('init', [$this, 'load_files']);
        add_action('admin_menu', [$this, 'create_settings_pages']);
        add_action('admin_enqueue_scripts', [$this, 'add_admin_styles']);
        add_filter('plugin_action_links_' . WP_STOREROCKET_NAME, [$this, 'add_links_to_plugin_settings']);
    }

    /**
     * Loads the classes files.
     */
    public function load_files()
    {
        require_once(WP_STOREROCKET_INC_DIR . 'helpers.class.php');
        require_once(WP_STOREROCKET_INC_DIR . 'settings.class.php');
        (new Settings())->init();
        require_once(WP_STOREROCKET_INC_DIR . 'shortcode.class.php');
        (new Shortcode())->init();
        require_once(WP_STOREROCKET_INC_DIR . 'editor.class.php');
        (new Editor())->init();
    }

    /**
     * Add a "Settings" link for the plugin in the Plugins page.
     *
     * @param $links
     * @return array
     */
    public function add_links_to_plugin_settings($links)
    {
        $link = esc_url(get_admin_url(get_current_blog_id(), 'admin.php?page=wp_storerocket_settings'));
        $settings_link = '<a href="' . $link . '">Settings</a>';
        $links[] = $settings_link;

        return $links;
    }

    /**
     * Creates the settings page for the plugin.
     */
    public function create_settings_pages()
    {
        (new Settings())->create_settings_pages();
    }

    /**
     * Enqueues the CSS for the admin settings page.
     */
    public function add_admin_styles()
    {
        wp_enqueue_style('wp-storerocket-admin', WP_STOREROCKET_DIR_URL . 'assets/css/admin.css');
    }

}

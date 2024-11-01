<?php

namespace WPStoreRocket;

/**
 * Settings class.
 *
 * Create the settings page and its controls.
 *
 * @package WPStoreRocket
 */
class Settings
{

    /**
     * Initializes settings registration.
     */
    public function init()
    {
        add_action('admin_init', [$this, 'register_wp_storerocket_settings']);
    }

    /**
     * Register the settings/controls used in the page.
     */
    public function register_wp_storerocket_settings()
    {
        add_settings_section('storerocket', '', null, 'wp_storerocket_settings');

        $args = [
            'id' => 'wp_storerocket_id',
            'type' => 'text',
            'label' => 'Account ID',
            'placeholder' => 'xxxxxxxxx',
            'value' => get_option('wp_storerocket_id'),
        ];

        add_settings_field(
            'wp_storerocket_id',
            'Your StoreRocket Account ID',
            [$this, 'render_text_field'],
            'wp_storerocket_settings',
            'storerocket',
            $args
        );

        register_setting(
            'storerocket',
            'wp_storerocket_id',
            'sanitize_text_field'
        );
    }

    /**
     * Add the menu link option in the admin menu.
     */
    public function create_settings_pages()
    {
        add_menu_page('StoreRocket', 'StoreRocket', 'manage_options', 'wp_storerocket_settings',
            [$this, 'create_settings_menu_page'], WP_STOREROCKET_DIR_URL . 'assets/img/storerocket_icon.png', 100
        );
    }

    /**
     * Callback for creating adding and registering page/settings.
     */
    public function create_settings_menu_page()
    {
        Helpers::get_template_part('admin', 'settings');
    }

    /**
     * Render a text field control used for the settings.
     */
    public function render_text_field($args)
    {
        ?>
        <input id="<?php echo esc_attr($args['id']); ?>" class="storerocket-input" type="<?php echo esc_attr($args['type']); ?>"
               name="<?php echo esc_attr($args['id']); ?>" value="<?php echo esc_attr($args['value']); ?>"
               placeholder="<?php echo esc_attr($args['placeholder']); ?>">
        <?php
    }
}

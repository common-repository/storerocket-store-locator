<?php

namespace WPStoreRocket;

/**
 * Class Editor.
 *
 * Sets up the TinyMCE plugin button and Javascript.
 *
 * @package WPStoreRocket
 */
class Editor
{

    /**
     * Initialize the buttons to the TinyMCE editor.
     */
    public function init()
    {
        if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages')) {
            return;
        }

        if ('true' !== get_user_option('rich_editing')) {
            return;
        }

        add_filter('mce_external_plugins', [$this, 'add_editor_buttons']);
        add_filter('mce_buttons', [$this, 'register_editor_buttons']);
        add_action('admin_head', [$this, 'tinymce_js_variables']);
    }

    /**
     * Callback for adding the editor buttons.
     *
     * @param array $plugins
     * @return array
     */
    public function add_editor_buttons($plugins)
    {
        $plugins['wpStoreRocket'] = WP_STOREROCKET_DIR_URL . 'assets/js/editor.js';

        return $plugins;
    }

    /**
     * Register the editor buttons
     *
     * @param array $buttons
     *
     * @return array
     */
    public function register_editor_buttons($buttons)
    {
        array_push($buttons, 'wpStoreRocket');

        return $buttons;
    }

    /**
     * Initialize a JavaScript variable for constructing the icon URL in the admin settings page.
     */
    public function tinymce_js_variables()
    {
        ?>
        <script>
            var storerocket_base_url = "<?php echo WP_STOREROCKET_DIR_URL; ?>";
        </script>
        <?php
    }

}

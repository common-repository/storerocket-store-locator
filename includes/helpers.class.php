<?php

namespace WPStoreRocket;

/**
 * Class Helpers.
 *
 * Set of helper functions used throughout the plugin.
 *
 * @package WPStoreRocket
 */
class Helpers
{

    /**
     * Returns the content for the shortcode.
     *
     * @return string|void
     */
    public static function get_storerocket_snippet_code()
    {
        $storerocket_id = get_option('wp_storerocket_id');
        $output = '';

        if (empty($storerocket_id)) {
            if (current_user_can('manage_options')) {
                static::showAccountNotValidWarning();
            }

            return;
        }

        ob_start();
        $output .= static::get_template_part('public', 'embed-code', [$storerocket_id]);
        $output .= ob_get_contents();
        ob_end_clean();

        return $output;
    }

    /**
     * If the account ID is not configured, show a warning message when the shortcode is rendered.
     */
    public static function showAccountNotValidWarning()
    {
        ?>
        <p style="background-color:lightyellow;padding: 10px;display:block;text-align:center">Please set a valid account
            ID in the <a style="font-weight: 500;"
                         href="<?php echo esc_url(get_admin_url(1,
                             'options-general.php?page=wp_storerocket_settings')); ?>"
                         target="_new">StoreRocket settings page</a>.
        </p>
        <?php
    }

    /**
     * Read and returns a template from a file.
     */
    public static function get_template_part($dir, $filename, $args = [], $echo = true)
    {
        $template = self::capture_template_part(WP_STOREROCKET_TEMPLATE_DIR . "{$dir}/{$filename}.php", $args);

        if ($echo) {
            echo $template;
        } else {
            return $template;
        }
    }

    private static function capture_template_part($file, $args = [])
    {
        ob_start();
        $template = require_once($file);
        $template = ob_get_contents();
        if ( ! empty($args)) {
            $pieces = implode(',', $args);
            $template = sprintf($template, $pieces);
        }
        ob_end_clean();

        return $template;
    }

}

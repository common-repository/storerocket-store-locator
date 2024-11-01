<?php

namespace WPStoreRocket;

/**
 * Shortcode class.
 *
 * Create the shortcode.
 *
 * @package WPStoreRocket
 */
class Shortcode
{

    /**
     * @var string The shortcode name.
     */
    public $shortcode_name = 'wp-storerocket';

    /**
     * Initialize the shortcode creation.
     */
    public function init()
    {
        add_shortcode($this->shortcode_name, [$this, 'setup_shortcode']);
    }

    /**
     * Renders the content for the shortcode.
     *
     * @return string
     */
    public function setup_shortcode()
    {
        return Helpers::get_storerocket_snippet_code();
    }

}

<?php

namespace WPStoreRocket;

/**
 * The HTML of the plugin settings page.
 */

?>

<div class="wp-storerocket-container wrap">

    <h1>StoreRocket Store Locator</h1>

    <div class="wp-storerocket-instructions">

        <div style="margin-bottom: 30px;">
            <h3 class="wp-storerocket-question">Where is my StoreRocket account ID?</h3>
            <p>You can find it inside your <a href="https://storerocket.io/app/account" target="_blank">account page</a> on StoreRocket.</p>
        </div>

        <h3 class="wp-storerocket-question">How can I show the store locator?</h3>

        <?php echo sprintf('To insert the store locator into a post or page, you can use the StoreRocket button %s in the visual editor toolbar.',
            '<img style="vertical-align: middle" src="' . WP_STOREROCKET_DIR_URL . 'assets/img/storerocket_icon.png" alt="StoreRocket Icon">'); ?>

        What it does is just inserting the shortcode <code>[wp_storerocket_code]</code> at the current position of the cursor in the editor.
        </ol>

    </div>

    <form method="post" action="options.php">
        <section class="wp-storerocket-settings-wrapper">
            <?php settings_fields('storerocket'); ?>
            <?php do_settings_sections('wp_storerocket_settings'); ?>
            <?php submit_button('Save'); ?>
        </section>
    </form>

</div>

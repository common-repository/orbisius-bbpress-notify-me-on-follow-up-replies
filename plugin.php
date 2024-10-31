<?php
/*
Plugin Name: Orbisius bbPress Notify Me On Follow Up Replies
Plugin URI: http://orbisius.com/
Description: The plugin makes sure that the checkbox 'Notify me of follow-up replies via email' below each forum reply is checked so the user is notified for new replies.
Version: 1.0.2
Author: Svetoslav Marinov (Slavi)
Author URI: http://orbisius.com
*/

/*  Copyright 2012 Svetoslav Marinov (Slavi) <slavi@orbisius.com>

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Set up plugin
add_action( 'init', 'orbisius_bbpress_always_notify_init' );

/**
 * Setups loading of assets (css, js)
 * @return type
 */
function orbisius_bbpress_always_notify_init() {
	add_action('admin_menu', 'orbisius_bbpress_always_notify_setup_admin');
	add_action('wp_footer', 'orbisius_bbpress_always_notify_add_plugin_credits', 1000); // be the last in the footer
	add_filter('bbp_get_form_topic_subscribed', 'orbisius_bbpress_always_notify_handle_checkbox', 10, 2);

    // when plugins are show add a settings link near my plugin for a quick access to the settings page.
    add_filter('plugin_action_links', 'orbisius_bbpress_always_notify_settings_link', 10, 2);
}

// Add the ? settings link in Plugins page very good
function orbisius_bbpress_always_notify_settings_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $settings_link = '<a href="options-general.php?page='
                . dirname(plugin_basename(__FILE__)) . '/' . basename(__FILE__) . '">' . (__("Settings", "WEBWEB_WP_PARTNER_WATCHER")) . '</a>';
        array_unshift($links, $settings_link);
    }

    return $links;
}

/**
 * Makes the notify me on future replies always checked.
 *
 * @param bool $checked
 * @param int $topic_subscribed
 * @return string
 * @see http://bbpress.org/forums/topic/make-notification-of-new-replies-auto-checked/
 */
function orbisius_bbpress_always_notify_handle_checkbox( $checked, $topic_subscribed  ) {
    if ($topic_subscribed == 0) {
        $topic_subscribed = true;
    }

    return checked( $topic_subscribed, true, false );
}

/**
 * Set up administration
 *
 * @package Orbisius bbPress Always Notify
 * @since 0.1
 */
function orbisius_bbpress_always_notify_setup_admin() {
	add_options_page( 'Orbisius bbPress Notify Me On Follow Up Replies', 'Orbisius bbPress Notify Me On Follow Up Replies', 5, __FILE__, 'orbisius_bbpress_always_notify_options_page' );
}

/**
 * Options page
 *
 * @package Orbisius bbPress Always Notify
 * @since 1.0
 */
function orbisius_bbpress_always_notify_options_page() {
    $permalink_structure = get_option('permalink_structure');
	?>
	<div class="wrap">
        <h2>Orbisius bbPress Notify Me On Follow Up Replies</h2>

        <h2>What does the plugin do?</h2>
        <p>
            The plugin makes sure that the checkbox <strong>Notify me of follow-up replies via email</strong> below each forum reply is checked
                so the user is notified for new replies. <br/>
                To see the plugin in action you must have bbPress installed and then go to your forums and try to post something.
        </p>

        <h2>Plugin Options</h2>
        <div class="updated">
            <p>Currently, the plugin does not require any configuration options.</p>
        </div>

        <h2>Join the Mailing List</h2>
        <p>
            Get the latest news and updates about this and future cool <a href="http://profiles.wordpress.org/lordspace/"
                                                                            target="_blank" title="Opens a page with the pugins we developed. [New Window/Tab]">plugins we develop</a>.
        </p>

        <p>
            <!-- // MAILCHIMP SUBSCRIBE CODE \\ -->
            1) <a href="http://eepurl.com/guNzr" target="_blank">Subscribe to our newsletter</a> (opens in a new window)
            <!-- \\ MAILCHIMP SUBSCRIBE CODE // -->
        </p>
        <p>OR</p>
        <p>
            2) Subscribe using our QR code. [Scan it with your mobile device].<br/>
            <img src="<?php echo plugin_dir_url(__FILE__); ?>/i/guNzr.qr.2.png" alt="" />
        </p>

        <h2>Support</h2>
        <p>
            <strong>
                ** NOTE: ** Support is handled on our site: <a href="http://club.orbisius.com/support/" target="_blank" title="[new window]">http://club.orbisius.com/support/</a>
                <br/>Please do NOT use the WordPress forums or other places to seek support.
            </strong>
        </p>

        <?php
            $app_link = 'http://club.orbisius.com/products/wordpress-plugins/bbpress-always-notify/';
            $app_title = 'Orbisius bbPress Always Notify';
            $app_descr = 'The plugin makes sure that the checkbox \'Notify me of follow-up replies via email\' below each forum reply is checked so the user is notified for new replies.';
        ?>
        <h2>Share</h2>
        <p>
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                <a class="addthis_button_facebook" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_twitter" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_google_plusone" g:plusone:count="false" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_linkedin" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_email" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_myspace" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_google" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_digg" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_delicious" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_stumbleupon" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_tumblr" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_favorites" addthis:url="<?php echo $app_link?>" addthis:title="<?php echo $app_title?>" addthis:description="<?php echo $app_descr?>"></a>
                <a class="addthis_button_compact"></a>
            </div>
            <!-- The JS code is in the footer -->

            <script type="text/javascript">
            var addthis_config = {"data_track_clickback":true};
            var addthis_share = {
              templates: { twitter: 'Check out {{title}} @ {{lurl}} (from @orbisius)' }
            }
            </script>
            <!-- AddThis Button START part2 -->
            <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=lordspace"></script>
            <!-- AddThis Button END part2 -->
        </p>

	</div>
	<?php
}

/**
* adds some HTML comments in the page so people would know that this plugin powers their site.
*/
function orbisius_bbpress_always_notify_add_plugin_credits() {
    printf(PHP_EOL . PHP_EOL . '<!-- ' . PHP_EOL . ' Powered by Orbisius bbPress Always Notify Plugin | Author URL: http://orbisius.com ' . PHP_EOL . '-->' . PHP_EOL . PHP_EOL);
}

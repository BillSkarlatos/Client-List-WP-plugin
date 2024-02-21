<?php
/**
 * Plugin Name: Customer Messaging Plugin
 * Description: Sends a message to a list of customers via their numbers.
 * Version: 0.1
 * Author: Bill Skarlatos.
 */

function enqueue_scripts_styles() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('customer-messaging-script', plugin_dir_url(__FILE__) . 'js/customer-messaging-script.js', array('jquery'), '1.0', true);
    wp_enqueue_style('customer-messaging-style', plugin_dir_url(__FILE__) . 'css/customer-messaging-style.css');
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_styles');

// Create shortcode for displaying the messaging form
function display_messaging_form() {
    ob_start(); ?>

    <div id="customer-messaging-container">
        <h2>Select Customer Numbers</h2>
        <form id="customer-messaging-form">
            <?php
            // Read customer numbers from file
            $file_path = plugin_dir_path(__FILE__) . 'contact_info.txt';
            $customer_numbers = file($file_path, FILE_IGNORE_NEW_LINES);

            if ($customer_numbers) {
                foreach ($customer_numbers as $number) {
                    echo '<label><input type="checkbox" name="selected_numbers[]" value="' . esc_attr($number) . '">' . esc_html($number) . '</label><br>';
                }
            } else {
                echo '<p>No customer numbers found.</p>';
            }
            ?>

            <h2>Message</h2>
            <textarea id="message" name="message" rows="4" maxlength="200" placeholder="Type your message (max 200 characters)"></textarea>

            <button type="button" id="send-button">Send</button>
        </form>
    </div>

    <div id="popup-message" style="display: none;"></div>

    <?php
    return ob_get_clean();
}
add_shortcode('customer_messaging', 'display_messaging_form');
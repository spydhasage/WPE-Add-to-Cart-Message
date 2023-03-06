<?php
/**
 * Plugin Name: WPE Add to Cart Message
 * Plugin URI: https://damilolasteven.com/
 * Description: A simple plugin to display a message to non-logged-in users when trying to add a product to the cart in WooCommerce.
 * Version: 1.0.0
 * Author: Damilola Ajila
 * Author URI: https://damilolasteven.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'woocommerce_add_to_cart_validation', 'wpe_custom_add_to_cart_validation', 10, 3 );
function wpe_custom_add_to_cart_validation( $passed, $product_id, $quantity ) {
    if ( ! is_user_logged_in() ) {
        $message = __( 'You need to <a href="%s">log in</a> or <a href="%s">sign up</a> before adding this product to the cart.', 'your-text-domain' );
        $login_url = 'https://domain.com/login/'; //Add your Login Url
        $register_url = 'https://domain.com/register/'; //Add your Registration Url
        $message = sprintf( $message, $login_url, $register_url );
        wc_add_notice( $message, 'error' );
        $passed = false;
    }
    return $passed;
}

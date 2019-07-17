<?php
/**
 * Plugin Name: Pickle Countdown
 * Plugin URI: https://github.com/erikdmitchell/pickle-countdown
 * Description: A simple and easy way to implement a countdown into your site.
 * Version: 1.1.0
 * Author: Erik Mitchell
 * Author URI:
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: pickle-countdown
 * Domain Path: /languages
 *
 * @package PickleCountdown
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Define PICKLE_COUNTDOWN_PLUGIN_FILE.
if ( ! defined( 'PICKLE_COUNTDOWN_PLUGIN_FILE' ) ) {
    define( 'PICKLE_COUNTDOWN_PLUGIN_FILE', __FILE__ );
}

// Include the main Pickle_Countdown class.
if ( ! class_exists( 'Pickle_Countdown' ) ) {
    include_once dirname( __FILE__ ) . '/class-pickle-countdown.php';
}

<?php
/**
 * Main Pickle Countdown class
 *
 * @package PickleCountdown
 * @since   1.0.0
 */

/**
 * Final Pickle_Countdown class.
 *
 * @final
 */
final class Pickle_Countdown {

    /**
     * Version
     *
     * (default value: '1.0.0')
     *
     * @var string
     * @access public
     */
    public $version = '1.0.0';

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Define constants.
     *
     * @access private
     * @return void
     */
    private function define_constants() {
        define( 'PICKLE_COUNTDOWN_PATH', plugin_dir_path( __FILE__ ) );
        define( 'PICKLE_COUNTDOWN_URL', plugin_dir_url( __FILE__ ) );
    }

    /**
     * Includes.
     *
     * @access public
     * @return void
     */
    public function includes() {

    }

    /**
     * Init hooks.
     *
     * @access private
     * @return void
     */
    private function init_hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
        add_shortcode( 'pickle_countdown', array( $this, 'shortcode' ) );
    }

    /**
     * Define function.
     *
     * @access private
     * @param mixed $name string.
     * @param mixed $value string.
     * @return void
     */
    private function define( $name, $value ) {
        if ( ! defined( $name ) ) {
            define( $name, $value );
        }
    }

    /**
     * Enqueue frontend scripts and styles.
     *
     * @access public
     * @return void
     */
    public function enqueue_scripts_styles() {
        wp_register_script( 'jquery-countdown-script', PICKLE_COUNTDOWN_URL . 'js/jquery.countdown.min.js', array( 'jquery' ), '2.2.0', true );
        wp_register_script( 'pickle-countdown-timer-settings-script', PICKLE_COUNTDOWN_URL . 'js/timerSettings.js', array( 'jquery-countdown-script' ), $this->version, true );
    }

    /**
     * Shortcode output.
     *
     * @access public
     * @param mixed $atts (array).
     * @return html
     */
    public function shortcode( $atts ) {
        $atts = shortcode_atts( array(
            'date' => '2020/01/01',
            'format' => '%D days %H:%M:%S',
        ), $atts, 'pickle-countdown' );
        
        $date = date('Y/m/d', strtotime($atts['date']));
        $format = apply_filters('pickle_countdown_format', $atts['format'], $atts);

        wp_localize_script(
            'pickle-countdown-timer-settings-script', 'pcTimerOptions', array(
                'date' => $date,
                'format' => $format,
            )
        );

        $html = '';

        $html .= '<div id="pickle-countdown">';
            $html .= '<div class="timer"></div>';
        $html .= '</div>';

        wp_enqueue_script( 'jquery-countdown-script' );
        wp_enqueue_script( 'pickle-countdown-timer-settings-script' );

        return $html;
    }

}

/**
 * Main function.
 *
 * @access public
 * @return class
 */
function pickle_countdown() {
    return new Pickle_Countdown();
}

// Global for backwards compatibility.
$GLOBALS['picklecalendar'] = pickle_countdown();

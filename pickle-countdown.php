<?php
/*
Plugin Name: Pickle Countdown
Plugin URI: 
Description: A simple and easy way to implement a countdown into your site.
Author: Erik Mitchell
Author URI: 
Version: 1.0.0
Text Domain: pickle-countdown
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

final class Pickle_Countdown {
	
	public $version = '1.0.0';
	
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();		
	}

	private function define_constants() {
		define('PICKLE_COUNTDOWN_PATH', plugin_dir_path(__FILE__));
		define('PICKLE_COUNTDOWN_URL', plugin_dir_url(__FILE__));
	}

	public function includes() {

	}

	private function init_hooks() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_styles'));
		add_shortcode('pickle_countdown', array($this, 'shortcode'));
	}

	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	public function enqueue_scripts_styles() {
		wp_register_script('jquery-countdown-script', PICKLE_COUNTDOWN_URL.'js/jquery.countdown.min.js', array('jquery'), '2.2.0', true);
		wp_register_script('pickle-countdown-timer-settings-script', PICKLE_COUNTDOWN_URL.'js/timerSettings.js', array('jquery-countdown-script'), $this->version, true);	
	}
	
	public function shortcode($atts) {		
		extract(shortcode_atts(array(
			'date' => '2020/01/01',
			'format' => '<div class="boomi-countdown">
			<div>
				<div class="count-number">%D</div>
				<div class="count-text">DAYS</div>
			</div>
			<span>:</span>
			<div>
				<div class="count-number">%H</div>
				<div class="count-text">HOURS</div>
			</div>
			<span>:</span>
			<div>
				<div class="count-number">%M</div>
				<div class="count-text">MINUTES</div>
			</div>
			<span>:</span>
			<div>
				<div class="count-number">%S</div>
				<div class="count-text">SECONDS</div>
			</div>
		</div>',
		), $atts, 'pickle-countdown'));
		
		wp_localize_script('pickle-countdown-timer-settings-script', 'pcTimerOptions', array(
			'date' => $date,
			'format' => $format,
		));
		
		$html='';
		
		$html.='<div id="pickle-countdown">';
			$html.='<div class="timer"></div>';
			$html.='<div class="text">'.$text.'</div>';
		$html.='</div>';
		
		wp_enqueue_script('jquery-countdown-script');
		wp_enqueue_script('pickle-countdown-timer-settings-script');
				
		return $html;
	}
		
}

new Pickle_Countdown();
?>
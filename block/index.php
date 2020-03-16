<?php
/**
 * Pickle Countdown block
 *
 * @package PickleCountdown
 * @since   1.2.0
 */

/**
 * Register block.
 *
 * @access public
 * @return void
 */
function pickle_countdown_register_block() {
    wp_register_script(
        'pickle-countdown-script',
        PICKLE_COUNTDOWN_BLOCK_URL . 'block.js',
        array( 'wp-blocks', 'wp-components', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-data' ),
        PICKLE_COUNTDOWN_VERSION
    );

    register_block_type(
        'pickle-countdown/block',
        array(
            'style' => 'pickle-countdown-style',
            'editor_style' => 'pickle-countdown-editor',
            'editor_script' => 'pickle-countdown-script',
        )
    );
}
add_action( 'init', 'pickle_countdown_register_block' );

/**
 * Add editor styles.
 *
 * @access public
 * @return void
 */
function pickle_countdown_block_editor_styles() {
wp_register_style(
        'pickle-countdown-editor',
        PICKLE_COUNTDOWN_BLOCK_URL . 'editor.css',
        array( 'wp-edit-blocks' ),
        PICKLE_COUNTDOWN_VERSION
    );
}
add_action( 'enqueue_block_editor_assets', 'pickle_countdown_block_editor_styles' );

/**
 * Add frontend styles.
 *
 * @access public
 * @return void
 */
function pickle_countdown_frontend_styles() {
    wp_enqueue_style(
        'pickle-countdown-style',
        PICKLE_COUNTDOWN_BLOCK_URL . 'style.css',
        array(),
        PICKLE_COUNTDOWN_VERSION
    );
}
add_action( 'enqueue_block_assets', 'pickle_countdown_frontend_styles' );

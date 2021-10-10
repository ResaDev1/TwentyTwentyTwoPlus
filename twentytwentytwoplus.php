<?php

/**
    * Plugin Name: TwentyTwentyTwoPlus
    * Author: The Resasadr dev team
    * Description: TwentyTwentyTwoPlus plugin
    * Version: 0.0.1
    * Requires at least: 5.8
    * License: GNU General Public License v3.0
    * License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

declare(strict_types=1);

/**
 * Enject style
 * @since 0.0.1
 */
function enject_style(string $style_name, string $css_file_path): void {
    wp_enqueue_style( $style_name, $css_file_path );
}

/**
 * When plugin activated,
 * This function runs.
 */
function main() {
    // Get plugin dir url
    $dir = plugin_dir_url(__FILE__);

    // Enject css to theme
    enject_style('TwentyTwentyTwoPlusStyle', $dir . 'css/style.css');
}

// Runs event enject action
add_action( 'wp_enqueue_scripts', 'main' );

// Plugin activated event
register_activation_hook( __FILE__, 'main' );

?>
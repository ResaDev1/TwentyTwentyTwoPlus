<?php

/**
    * Plugin Name: TwentyTwentyTwoPlus
    * Author: The Resasadr dev team
    * Description: TwentyTwentyTwoPlus plugin
    * Version: 0.1.0
    * Requires at least: 5.8
    * License: GNU General Public License v3.0
    * License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/


declare(strict_types=1);

include 'php/log.php';
include 'php/version.php';
include 'php/db.php';

// Get plugin dir url
$dir = plugin_dir_url(__FILE__);

// Create Log object
$log = new Log();

const INFO = "INFO";
const DB_TABLE = "tttp";

/**
 * Register Menu
 * @return void
 * @since 0.0.1
 */
function register_menu(): void {
    global $log;

    /**
     * Code refrence: https://developer.wordpress.org/reference/functions/add_menu_page/
     */
    add_menu_page( 'Twenty Twenty Plus',
        'TwTP',
        'manage_options',
        'tttp',
        'menu_page',
        '',
        90
    );
    $log->push(INFO, "Menu created.");
}
add_action( 'admin_menu', 'register_menu' );

/**
 * Menu page
 * include Menu file to show plugin panel page
 * @return void
 */
function menu_page(): void {
    global $log;

    $file_name = "php/menu.php";
    include_once plugin_dir_path( __FILE__ ) . $file_name;

    $log->push(INFO, "File loaded -> " . $file_name);
}

/**
 * Enject style
 * Enqueue Css to theme
 * @return void
 * @since 0.0.1
 */
function inject_style(string $style_name, string $css_file_path): void {
    wp_enqueue_style( $style_name, $css_file_path );
}

/**
 * When plugin activated,
 * This function runs.
 * @since 0.0.1
 */
function main() {
    global $dir;

    // Create table in database
	Db::create_table(DB_TABLE,
		"
            id INT PRIMARY KEY AUTO_INCREMENT,
			param VARCHAR(100),
			value VARCHAR(200)
		"
	);
    
    // Enject css to theme
    inject_style('TwentyTwentyTwoPlusStyle', $dir . 'dist/main.bundle.css');
}

// Runs event enject action
add_action( 'wp_enqueue_scripts', 'main' );

$log->push(INFO, "Style injected.");

// Plugin activated event
register_activation_hook( __FILE__, 'main' );

/**
 * Returns array of logs
 * @return array
 * @since 0.0.1
 */
function get_logs(): array {
    global $log;

    return $log->messages;
}

/**
 * Returns current version of plugin
 * @return string
 * @since 0.0.1
 */
function get_plugin_version(): string {
    return PLUGIN_VERSION;
}

/**
 * Check if dark mode enabled. then inject css
 * @since 0.0.2
 * @return void
 */
function dark_theme(): void {
    global $dir;

    $result = Db::get("SELECT value FROM wp_" . DB_TABLE . " WHERE param='darkMode'");
    if ($result) {
        // Inject dark theme css
        if ($result[0]->value == "1") {
            inject_style("TTTPDark", $dir . "css/dark-theme.css");
        }
    }
}
add_action( 'wp_enqueue_scripts', 'dark_theme' );

/**
 * Inject javascript to theme
 * @since 0.0.2
 * @return void
 */
function inject_script(): void {
    global $dir;
    
    wp_enqueue_script('script', $dir . 'dist/bundle.js');
}
add_action('wp_enqueue_scripts', 'inject_script');

?>
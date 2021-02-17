<?php
/**
 * Plugin Name: WP GraphQL Plus
 * Plugin URI: https://github.com/abhijitrakas/wp-graphql-plus
 * GitHub Plugin URI: https://github.com/abhijitrakas/wp-graphql-plus
 * Description: Few new features and Extending some WPGraphQL APIs for WordPress.
 * Author: Abhijit Rakas
 * Author URI: https://github.com/abhijitrakas
 * Version: 0.0.1
 * Text Domain: wp-graphql-plus
 * Domain Path: /languages/
 * Requires at least: 5.0
 * Tested up to: 5.4
 * Requires PHP: 7.1
 * License: GPL-3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package WPGraphQLPlus
 */

define( 'WP_GRAPHQL_PLUS_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WP_GRAPHQL_PLUS_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );

// phpcs:disable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant
require_once WP_GRAPHQL_PLUS_PATH . '/inc/helpers/autoloader.php';
require_once WP_GRAPHQL_PLUS_PATH . '/inc/helpers/custom-functions.php';
// phpcs:enable WordPressVIPMinimum.Files.IncludingFile.UsingCustomConstant

/**
 * To load plugin manifest class.
 *
 * @return void
 */
function wp_graphql_plus_plugin_loader() {
	\WPGraphQLPlus\Inc\Main::get_instance();
}

wp_graphql_plus_plugin_loader();

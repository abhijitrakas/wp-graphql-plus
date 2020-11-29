<?php
/**
 * Plugin manifest class.
 *
 * @package WPGraphQLPlus
 */

namespace WPGraphQLPlus\Inc;

use \WPGraphQLPlus\Inc\Traits\Singleton;

/**
 * Class Main
 */
class Main {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load plugin classes.
		Fields::get_instance();

	}

}

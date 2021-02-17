<?php
/**
 * Plugin manifest class.
 *
 * @package WPGraphQLPlus
 */

namespace WPGraphQLPlus\Inc;

use \WPGraphQLPlus\Inc\Fields\Users;
use \WPGraphQLPlus\Inc\Fields\Sidebars;
use \WPGraphQLPlus\Inc\Traits\Singleton;

/**
 * Class Fields
 */
class Fields {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		// Load plugin classes.
		Users::get_instance();
		Sidebars::get_instance();

	}

}

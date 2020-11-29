<?php
/**
 * Plugin manifest class.
 *
 * @package WPGraphQLPlus
 */

namespace WPGraphQLPlus\Inc\Fields;

use \WPGraphQLPlus\Inc\Traits\Singleton;

/**
 * Class Sidebars
 */
class Sidebars {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		/**
		 * Actions.
		 */
		add_action( 'graphql_register_types', [ $this, 'register_fields' ] );

	}

	public function register_fields() {

		global $wp_registered_sidebars;

		if ( empty( $wp_registered_sidebars ) ) {
			return;
		}

		$registered_sidebar = [];

		foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
			$field_name                      = wp_gql_plus_make_camel_case( $sidebar['name'] );
			$registered_sidebar[$field_name] = [
				'type'        => 'String',
				'description' => $sidebar['description'],
			];
		}

		register_graphql_object_type(
			'SidebarFields',
			[
				'description' => esc_html__( 'All registered sidebars', 'wp-graphql-plus' ),
				'fields'      => $registered_sidebar
			]
		);

		register_graphql_field(
			'RootQuery',
			'widgets',
			[
				'type'        => 'SidebarFields',
				'description' => esc_html__( 'Get sidebar data', 'wp-graphql-plus' ),
				'resolve'     => function() use($wp_registered_sidebars) {
					$data = [];

					foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
						$field_name        = wp_gql_plus_make_camel_case( $sidebar['name'] );
						$data[$field_name] = $this->get_sidebar_data( $sidebar_id );
					}

					return $data;
				}
			]
		);

	}

	/**
	 * Function to get sidebar data using sidebar id.
	 *
	 * @param string $sidebar_id Sidebar ID.
	 *
	 * @return string
	 */
	private function get_sidebar_data( $sidebar_id ) {

		$sidebar_content = '';

		if ( is_active_sidebar( $sidebar_id ) ) {
			ob_start();

			get_sidebar( $sidebar_id );

			$sidebar_content = ob_get_contents();

			ob_end_clean();
		}

		return $sidebar_content;
	}

}

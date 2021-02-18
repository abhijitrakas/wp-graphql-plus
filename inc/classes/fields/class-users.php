<?php
/**
 * Plugin users class.
 *
 * @package WPGraphQLPlus
 */

namespace WPGraphQLPlus\Inc\Fields;

use \WPGraphQLPlus\Inc\Traits\Singleton;
use WPGraphQL\Data\Connection\PostObjectConnectionResolver;

/**
 * Class Users
 */
class Users {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		/**
		 * Actions.
		 */
		add_action( 'graphql_register_types', [ $this, 'register_field' ] );

	}

	/**
	 * Function to register userPosts field.
	 *
	 * @return mixed
	 */
	public function register_field() {

		// Register post types.
		$post_types_args   = [ 'public'   => true ];
		$post_types        = get_post_types( $post_types_args, 'objects' );
		$public_post_types = [];

		foreach ( $post_types as $post_type ) {

			if ( 'attachment' === $post_type->name ) {
				continue;
			}

			$public_post_types[] = $post_type->name;
		}

		/**
		 * Filter to modify the list of public post types.
		 *
		 * @since 0.0.1
		 */
		$public_post_types = apply_filters( 'wp_graphql_plus_public_post_type', $public_post_types );

		$config = [
			'fromType'           => 'User',
			'toType'             => 'Post',
			'fromFieldName'      => 'userPosts',
			'connectionTypeName' => 'UserPostsConnection',
			'resolve'            => function( $user, $args, $context, $info ) use( $public_post_types ) {

				$user_id    = $user->__get( 'userId' ); // Get user id.
				$connection = new PostObjectConnectionResolver( $user, $args, $context, $info, $public_post_types );
				$connection->set_query_arg( 'author', (int) $user_id );
				return $connection->get_connection();
			},
		];

		register_graphql_connection( $config );

	}

}

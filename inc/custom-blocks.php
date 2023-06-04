<?php
/**
 * Custom ACF blocks for use with this theme
 */

add_action( 'acf/init', 'my_acf_init_block_types' );

/**
 * Init custom acf blocks
 */
function my_acf_init_block_types() {

	// Check function exists.
	// if ( function_exists( 'acf_register_block_type' ) ) {
		// Register Hero Block
		// acf_register_block_type(array(
		// 'name'              => 'home_hero',
		// 'title'             => __('Home Hero'),
		// 'description'       => __('Home Hero'),
		// 'render_template'   => 'template-parts/blocks/home-hero/home-hero.php',
		// 'category'          => 'theline-blocks',
		// 'icon'              => 'cover-image',
		// 'keywords'          => array( 'hero', 'image', 'video' ),
		// ));
	// }
}

add_action( 'block_categories', 'custom_block_categories', 10, 2 );

/**
 * Add Custom Block Categories
 *
 * @param array $categories Default block categories
 *
 * @return array $categories Updated block categories
 */
function custom_block_categories( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'am-blocks',
				'title' => 'AM Blocks',
			),
		)
	);
}

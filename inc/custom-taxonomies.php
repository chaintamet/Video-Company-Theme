<?php
/**
 * Custom taxonomies for use with this theme
 */

add_action( 'init', 'custom_taxonomies' );

/**
 * Adds custom taxonomies
 */
function custom_taxonomies() {
	// Member category
	register_taxonomy(
		'member_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'member',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Roles', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'member',    // This controls the base slug that will display before each term
				'with_front' => false  // Don't display the category base before
			),
			'show_in_rest' => true
		)
	);

	// Talent category
	register_taxonomy(
		'talent_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'talent',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Roles', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'talent',    // This controls the base slug that will display before each term
				'with_front' => false  // Don't display the category base before
			),
			'show_in_rest' => true
		)
	);

	// Project category
	register_taxonomy(
		'project_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'project',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Roles', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'project',    // This controls the base slug that will display before each term
				'with_front' => false  // Don't display the category base before
			),
			'show_in_rest' => true
		)
	);

	// Intelligence category
	register_taxonomy(
		'intelligence_category',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'intelligence',             // post type name
		array(
			'hierarchical' => true,
			'label'        => 'Categories', // display name
			'query_var'    => true,
			'rewrite'      => array(
				'slug'       => 'intelligence',    // This controls the base slug that will display before each term
				'with_front' => false  // Don't display the category base before
			),
			'show_in_rest' => true
		)
	);
}

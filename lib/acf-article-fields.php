<?php


/**
 * Register article fields.
 */
if( \function_exists('acf_add_local_field_group') ) {

	acf_add_local_field_group(array (
		'key' => 'relevan_posts',
		'title' => __('Relevant posts', 'leijonaa'),
		'fields' => array (
			array (
				'key' => 'relevant',
				'label' => __('Choose up to three articles', 'leijonaa' ),
				'name' => 'relevant',
				'type' => 'relationship',
				'instructions' => __('The user gets these as recommendation after this article. <br>
	If less than three articles are chosen, the rest is fetched automatically from the same category.' , 'leijonaa'),
				'required' => 0,
				'post_type' => array (
					0 => 'post',
				),
				'taxonomy' => array (
				),
				'filters' => array (
					0 => 'search',
				),
				'max' => 3,
				'return_format' => 'object',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 1,
	));
}
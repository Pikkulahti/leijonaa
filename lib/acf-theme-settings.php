<?php

namespace leijonaa\CustomFields;

/**
 * Register theme options page.
 */
if( \function_exists('acf_add_options_page') ) {
	
	\acf_add_options_page( array(
		'page_title' 	=> __( 'Theme Settings', 'leijonaa' ),
		'menu_title'	=> __( 'Theme Settings', 'leijonaa' ),
		'menu_slug' 	=> 'theme-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url' 		=> 'dashicons-admin-customizer', 
		'position'		=> 15,
	));
}


/**
 * Register author introduction fields to theme settings.
 */
if( \function_exists('acf_add_local_field_group') ) {
	acf_add_local_field_group(array (
		'key' => 'ljn_author-fields',
		'title' => __('Hi! Nice to meet you.', 'leijonaa' ),
		'fields' => array (
			array (
				'key' => 'ljn_author-message',
				'type' => 'message',
				'message' => __(' Here you\'ll get to show us who is the awesome superstar behind this blog.<br> Get creative and write a intro about you, snap a awesome closeup and give your name and email.', 'leijonaa' ),
				'new_lines' => 'wpautop',
				'esc_html' => 0,
			),
			array (
				'key' => 'ljn_author-wrapper',
				'label' => __('Basic info', 'leijonaa'),
				'name' => 'ljn_author-wrapper',
				'type' => 'repeater',
				'wrapper' => array (
					'width' => '50',
				),
				'min' => 1,
				'max' => 1,
				'layout' => 'block',
				'sub_fields' => array (
					array (
						'key' => 'ljn_author-name',
						'label' => __('Author name', 'leijonaa'),
						'name' => 'ljn_author-name',
						'type' => 'text',
						'instructions' => __('Used as title of the author info section.', 'leijonaa'),
						'placeholder' => __('Your name',  'leijonaa'),
					),
					array (
						'key' => 'ljn_author-email',
						'label' => 'Author email',
						'name' => 'ljn_author-email',
						'type' => 'email',
						'instructions' => __('Email address is obfuscated so it\'s nonsense for bots, but readable for humans.', 'leijonaa'),
						'placeholder' => __('your@email.com', 'leijonaa'),
					),
					array (
						'key' => 'ljn_author-image',
						'label' => __('Author image', 'leijonaa'),
						'name' => 'ljn_author-image',
						'type' => 'image',
						'instructions' => __('Minimum image size is 150 x 150 pixels. <br/>
	Maximum image size is 300 x 300 pixels. <br/>
	Image aspect ratio is 1 : 1.', 'leijonaa'),
						'return_format' => 'array',
						'preview_size' => 'thumbnail',
						'library' => 'all',
						'min_width' => 150,
						'min_height' => 150,
						'max_width' => 300,
						'max_height' => 300,
					),
				),
			),
			array (
				'key' => 'ljn_author-intro',
				'label' => __('Author introduction', 'leijonaa'),
				'name' => 'ljn_author-intro',
				'type' => 'wysiwyg',
				'instructions' => __('~40 characters per line. <br/>
	No maximum limit but please consider using no more than 400 characters.', 'leijonaa'),
				'wrapper' => array (
					'width' => '50',
				),
				'tabs' => 'all',
				'toolbar' => 'basic',
				'media_upload' => 0,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-settings',
				),
			),
		),
		'menu_order' => 1,
	));
	/**
	 * Register hero image field to theme settings page.
	 */
	acf_add_local_field_group(array (
		'key' => 'ljn_hero-fields',
		'title' => 'Hero image',
		'fields' => array (
			array (
				'key' => 'ljn_hero-image',
				'label' => __('Instructions', 'leijonaa'),
				'name' => 'ljn_hero-image',
				'type' => 'image',
				'instructions' => __('If set, blog\'s hero image is located after the top menu in front page. <br/>
	Minimum image size: 1920 x 480 pixels. <br/>
	Maximum image size: 3840 x 960 pixels. <br/>
	Image ratio 4 : 1.', 'leijonaa'),
				'wrapper' => array (
					'class' => 'ljn_hero-image',
				),
				'return_format' => 'array',
				'preview_size' => 'medium_large',
				'min_width' => 1920,
				'min_height' => 480,
				'max_width' => 3840,
				'max_height' => 960,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-settings',
				),
			),
		),
		'menu_order' => 2,
		'label_placement' => 'left',
		'instruction_placement' => 'label',
		'active' => 1,
	));
}
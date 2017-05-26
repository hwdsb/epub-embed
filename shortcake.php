<?php
/**
 * Shortcake support for ePub Embed.
 *
 * @package epub-embed
 */

/**
 * Register shortcode with Shortcake.
 */
shortcode_ui_register_for_shortcode(
	'epub',
	array(

		'label' => __( 'ePub', 'epub-embed' ),

		'listItemImage' => 'dashicons-book-alt',

		'attrs' => array(
			array(
				'label' => __( 'Attachment Post ID', 'epub-embed' ),
				'attr'  => 'id',
				'type'  => 'text',
				'description' => __( 'Enter the attachment post ID that contains the ePub file.', 'epub-embed' )
			),

			array(
				'label' => __( 'Width', 'epub-embed' ),
				'attr'  => 'width',
				'type'  => 'number',
				'meta' => array(
					'style' => 'width:75px'
				),
				'description' => __( "Enter width in pixels. If left blank, this defaults to the theme's width.", 'epub-embed' )
			),

			array(
				'label' => __( 'Height', 'epub-embed' ),
				'attr'  => 'height',
				'type'  => 'number',
				'meta' => array(
					'style' => 'width:75px'
				),
				'description' => __( "Enter height in pixels. If left blank, this defaults to 700.", 'epub-embed' )
			),

			array(
				'label' => __( 'Add Download Link', 'epub-embed' ),
				'attr'  => 'downloadlink',
				'type' => 'select',
				'options' => array(
					'1' => __( 'Yes', 'epub-embed' ),
					'' => __( 'No', 'epub-embed' ),
				),
				'description' => __( 'If checked, this adds a download link after the ePub embed.', 'epub-embed' )
			),
		),

	)
);
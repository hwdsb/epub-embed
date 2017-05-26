<?php
/*
Plugin Name: ePub Embed
Description: Easily embed eBooks published in the ePub format.
Author: r-a-y
Author URI: http://profiles.wordpress.org/r-a-y
Version: 0.1-alpha
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Loader.
 */
add_action( 'plugins_loaded', array( 'Ray_ePub', 'init' ) );

/**
 * Core class for ePub Embed.
 *
 * The ePub reader is powered by Readium JS Viewer, licensed under the BSD.
 *
 * @link https://github.com/readium/readium-js-viewer
 * @link https://github.com/readium/readium-js-viewer/blob/master/license.txt
 */
class Ray_ePub {
	/**
	 * URL property.
	 *
	 * @var string
	 */
	public static $URL = '';

	/**
	 * Static initializer.
	 */
	public static function init() {
		return new self();
	}

	/**
	 * Constructor.
	 */
	protected function __construct() {
		self::$URL = plugins_url( basename( __DIR__ ) ) . '/';

		// Register shortcode.
		add_action( 'init', function() {
			add_shortcode( 'epub', array( $this, 'shortcode' ) );
		} );

		// Shortcake support.
		add_action( 'register_shortcode_ui', function() {
			require __DIR__ . '/shortcake.php';
		} );

		// Load AJAX code when an AJAX request is requested.
		add_action( 'admin_init', function() {
			if ( defined( 'DOING_AJAX' ) && true === DOING_AJAX && isset( $_POST['action'] ) && 0 === strpos( $_POST['action'], 'send-attachment-to-editor' ) ) {
				require __DIR__ . '/ajax.php';
			}
		} );

		// Allow ePubs to be uploaded.
		add_filter( 'upload_mimes', function( $retval ) {
			$retval['epub'] = 'application/epub+zip';
			return $retval;
		} );
	}

	/**
	 * Shortcode to embed an ePub file.
	 *
	 * eg. [epub id="ATTACHMENT_POST_ID"]
	 *
	 * @param array $atts {
	 *     Array of shortcode arguments.
	 *     @type int        $id           The attachment post ID containing the ePub file.
	 *     @type string     $link         Link to ePub file.  Currently unused due to CORS issues.
	 *     @type bool       $downloadlink Should we display a download link to the ePub? If true, displays after the
	 *                                    embed. Default: true.
	 *     @type int|string $width        Width for the ePub for embedding. Can be integer or percentage. Defaults to
	 *                                    the current theme's content width. If not available, defaults to '100%'.
	 *     @type int        $height       Height for the ePub for embedding. Default: 700.
	 * }
	 */
	public function shortcode( $atts ) {
		$r = shortcode_atts( array(
			'id'           => false,
			'link'         => false,
			'downloadlink' => true,

			// dimensions
			'width'  => ! empty( $GLOBALS['content_width'] ) ? $GLOBALS['content_width'] : '100%',
			'height' => 700,
		), $atts );

		// if no post ID, stop now!
		if ( ! $r['id'] ) {
			return;
		}

		$output = '';

		if ( $r['id'] ) {
			// Sanity check for ePub.
			if ( 'application/epub+zip' !== get_post( $r['id'] )->post_mime_type ) {
				return;
			}

			$output = '<iframe id="epub-' . esc_attr( $r['id'] ) . '" src="' . add_query_arg( 'epub', urlencode( wp_get_attachment_url( $r['id'] ) ), self::$URL . 'reader/' ). '" width="' . esc_attr( $r['width'] ) . '" height="' . esc_attr( $r['height'] ) . '" allowfullscreen></iframe>';

			// Add download link if enabled.
			if ( true === wp_validate_boolean( $r['downloadlink'] ) ) {
				$link = '<p class="epub-download"><span class="dashicons dashicons-download"></span><a href="' . wp_get_attachment_url( $r['id'] ) . '">' . __( 'Download', 'epub-embed' ). '</a></p>';
				$output .= $link;
			}
		}

		return apply_filters( 'ray_epub_shortcode_output', $output );
	}
}

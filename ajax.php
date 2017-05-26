<?php
/**
 * AJAX code for ePub Embed.
 *
 * @package epub-embed
 */

/**
 * Modifies the AJAX response when the "Insert to Post" button is clicked.
 *
 * Only takes place if the attachment is an ePub file.
 *
 * @since 0.1
 *
 * @param  string $retval     Current AJAX return value.
 * @param  int    $id         Attachment post ID.
 * @param  array  $attachment Attachment info from Backbone.
 * @return string
 */
function ray_epub_modify_send_to_editor( $retval, $id, $attachment ) {
	if ( 'application/epub+zip' !== get_post( $id )->post_mime_type ) {
		return $retval;
	}
	return "[epub id='{$id}']";
}
add_filter( 'media_send_to_editor', 'ray_epub_modify_send_to_editor', 10, 3 );
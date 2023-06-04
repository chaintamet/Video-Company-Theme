<?php
/**
 * Customise the log-in page and admin dashboard area logo
 */

/**
 * Change admin logo url
 */
function am_login_logo_url() {
	return esc_url( home_url( '/' ) );
}

// Add Gogole Map API

// function am_acf_google_map_key() {
// acf_update_setting('google_api_key', 'AIzaSyC7sM9aEtND4xIBlMICYkk8fOUMRvt-Tqc');
// }
// add_action('acf/init', 'am_acf_google_map_key');

/**
 * Retina 2x plugin supprt: get URL
 *
 * @param string $url URL of retina image
 * @return string
 */
function am_get_retina( $url ) {
	if ( ! function_exists( 'wr2x_get_retina_from_url' ) ) {
		return $url;
	}

	$url_temp = wr2x_get_retina_from_url( $url );

	if ( ! empty( $url_temp ) ) {
		return $url_temp;
	} else {
		return $url;
	}
}

/**
 * Retina 2x plugin supprt: return IMG
 *
 * @param string $url_normal Normal Image URL
 * @param string $class class of img tag
 * @param int    $w Width of img
 * @param int    $h Height of img
 * @param string $alt Alt text of img
 * @return string Retina img tag
 */
function am_get_retina_img( $url_normal, $class = '', $w = '', $h = '', $alt = '' ) {
	$url_retina = am_get_retina( $url_normal );
	$srcset     = '';
	if ( $url_retina ) {
		$srcset = ' srcset="' . $url_retina . ' 2x"';
	}

	$width = '';
	if ( $w ) {
		$width = ' width="' . $w . 'px"';
	}
	$height = '';
	if ( $h ) {
		$height = ' height="' . $h . 'px"';
	}
	return '<img src="' . $url_normal . '"' . $srcset . $width . $height . ' alt="' . $alt . '" class="' . $class . '">';
}

add_action( 'acf/update_value/name=location', 'am_update_lng_and_lat', 10, 3 );

/**
 * Add lat and lng to data
 *
 * @param array $value Lat and Lng
 * @param int   $post_id Post ID
 * @param mixed $field field
 * @return mixed
 */
function am_update_lng_and_lat( $value, $post_id, $field ) {
	update_post_meta( $post_id, 'lat', $value['lat'] );
	update_post_meta( $post_id, 'lng', $value['lng'] );
	return $value;
}


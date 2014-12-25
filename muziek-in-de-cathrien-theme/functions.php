<?php

/**
 * New Excerpt More
 *
 * @return string
 */
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Custom Excerpt Length
 *
 * @return integer
 */
function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Get current page depth
 *
 * @return integer
 */
function get_current_page_depth(){
	global $wp_query;
	
	$object = $wp_query->get_queried_object();
	$parent_id  = $object->post_parent;
	$depth = 0;
	while($parent_id > 0){
		$page = get_page($parent_id);
		$parent_id = $page->post_parent;
		$depth++;
	}
 
 	return $depth;
}

/**
 * Get page depth
 *
 * @return integer
 */
function get_page_depth($page){
	global $wp_query;
	
	$parent_id  = $page->post_parent;
	$depth = 0;
	while($parent_id > 0){
		$page = get_page($parent_id);
		$parent_id = $page->post_parent;
		$depth++;
	}
 
 	return $depth;
}

/**
 * Get ID of the current page in a given culture.
 * Returns the page ID for the following strings: nl_NL | en_GB | de_DE | fr_FR
 * If the page does not have an equivalent in the selected country, it returns null.
 *
 * @return integer
 */
function get_page_translated_id($culture)
{
	global $wp_query;
	$current_page = get_page($wp_query->get_queried_object());

	$lang = null;
	switch ($culture) {
		case 'nl_NL': $lang = 'lang-nl_nl'; break;
		case 'en_GB': $lang = 'lang-en_gb'; break;
		case 'de_DE': $lang = 'lang-de_de'; break;
		case 'fr_FR': $lang = 'lang-fr_fr'; break;
	}

	$translated_page_id = get_post_meta($current_page->ID, $lang, true);
	return $translated_page_id;
}

?>
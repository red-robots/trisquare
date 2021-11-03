<?php
/**
 * bellaworks functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package bellaworks
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/scripts.php';

/**
 * Custom Post Types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Post Pagination
 */
require get_template_directory() . '/inc/pagination.php';


/**
 * Theme Specific additions.
 */
require get_template_directory() . '/inc/theme.php';

/**
 * Block & Disable All New User Registrations & Comments Completely.
 * Description:  This simple plugin blocks all users from being able to register no matter what, 
 *				 this also blocks comments from being able to be inserted into the database.
 */
require get_template_directory() . '/inc/block-all-registration-and-comments.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

require get_template_directory() . '/inc/ajax.php';

//custom_insert_new_user();

function custom_insert_new_user() {
	global $wpdb;
	$userdata = array(
		   'user_login'       =>  'user2020',
		   'user_pass'        =>  'pass123',
		   'user_email'       =>  'lisaquiamco@outlook.com',
		   'user_registered'  =>  date_i18n( 'Y-m-d H:i:s', time() ),
		   'role'             =>  'administrator'
	   );
	   
	$user_id = wp_insert_user( $userdata );
	$lastid = $wpdb->insert_id;
	if($lastid) {
		echo '<h2>USER ADDED!!!!</h2>';
	}

}



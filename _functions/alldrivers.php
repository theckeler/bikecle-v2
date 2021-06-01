<?
function all_drivers_upload(){
	global $wpdb;

	echo '<p>Loading Photo...</p>';

	$my_post = array(
		'post_title'    => $_POST['alldriver_title'],
		'post_type' => 'alldrivers',
		'post_status'   => 'pending',
		'post_author'   => 1,
		'tax_input' => array('alldrivers_type' => 'user-submitted')
	);
	$post_id = wp_insert_post($my_post);
	
	$term_taxonomy_ids = wp_set_object_terms($post_id,72,'alldrivers_type');
	
	if ( is_wp_error( $term_taxonomy_ids ) ):
		echo '<p>There has been an error adding category.</p>';
	endif;


	if ( isset($_POST['my_image_upload_nonce'], $post_id) && wp_verify_nonce($_POST['my_image_upload_nonce'], 'my_image_upload') ):
		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		require_once( ABSPATH . 'wp-admin/includes/file.php' );
		require_once( ABSPATH . 'wp-admin/includes/media.php' );
		$attachment_id = media_handle_upload( 'my_image_upload', $post_id );
		
		set_post_thumbnail( $post_id, $attachment_id );
		echo '<p>Success!</p>';

	else:
		echo '<p>There has been an error.</p>';
	endif;

}


function all_drivers_form(){

?>
<form id="featured_upload" method="post" action="#" enctype="multipart/form-data">
	<input name="alldriver_title" placeholder="... Driver" id="alldriver-title">
	
	<input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
	<?php wp_nonce_field( 'my_image_upload', 'my_image_upload_nonce' ); ?>
	<input id="submit_my_image_upload" name="submit_my_image_upload" type="submit" value="Upload" />
</form>
<?

}



?>
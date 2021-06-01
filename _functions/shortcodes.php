<?

function large_img_function( $atts, $content = "" ){
	remove_filter( 'the_content', 'wpautop' );

	$image = wp_get_attachment_image_src( $atts['photo_id'], 'large' );
	$return_me = '<div class="home large-img" style="background-image: url('.$image[0].');"><a href="'.$atts['url'].'"><h3>'.$atts['title'].'</h3><p>'.$content.'</p><p><button>Click Here</button></p></a></div>';
	return $return_me;
}
add_shortcode( 'large_img', 'large_img_function' );



function icons_new_function( $atts, $content = "" ){
	remove_filter( 'the_content', 'wpautop' );
	
	$content = str_replace('<br />','',$content);
	$return_me = '<div class="content home-links"><div class="max-width">'.do_shortcode( $content ).'</div></div>';
	return $return_me;
}
add_shortcode( 'icons', 'icons_new_function' );


function icon_function( $atts, $content = "" ){
	remove_filter( 'the_content', 'wpautop' );

	$image = wp_get_attachment_image_src( $atts['photo_id'], 'full' );
	$return_me = '<a href="'.$atts['url'].'"><img src="'.$image[0].'"><h2>'.$atts['title'].'</h2><p>'.$content.'</p></a>';
	return $return_me;
}
add_shortcode( 'icon', 'icon_function' );


function buttons_function( $atts, $content = "" ){
	remove_filter( 'the_content', 'wpautop' );
	
	$button_count = substr_count($content,"[button");
	$GLOBALS['button_count'] = $button_count;
	
	$content = str_replace('<br />','',$content);
	$return_me = '<div class="content buttons"><div class="max-width blocks-'.$GLOBALS['button_count'].'">'.do_shortcode( $content ).'</div></div>';
	return $return_me;
}
add_shortcode( 'buttons', 'buttons_function' );

function button_function( $atts, $content = "" ){
	remove_filter( 'the_content', 'wpautop' );
	static $count = 0;
	$count++;

	$width = (100/$GLOBALS['button_count'])-1;

	$image = wp_get_attachment_image_src( $atts['photo_id'], 'medium' );
	$return_me = '<a href="'.$atts['url'].'" style="width: '.$width.'%;background-image: url('.$image[0].');" class="button-'.$count.'"><p>'.$content.'</p><span></span><h2>'.$atts['title'].'</h2></a>';
	return $return_me;
}
add_shortcode( 'button', 'button_function' );

function text_block_function( $atts, $content = "" ){
	//remove_filter( 'the_content', 'wpautop' );

	$return_me = '<div class="content page"><div class="max-width">'.$content.'</div></div>';
	return $return_me;
}
add_shortcode( 'text_block', 'text_block_function' );

?>
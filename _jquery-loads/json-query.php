<?
require_once ($_SERVER["DOCUMENT_ROOT"].'/wp-load.php');
//$post_ID = get_post($_POST['post_ID']);


//echo '<pre>';print_r($args);echo'</pre>';
if( $_GET['getPosts'] == 'attachment' ):
	//$posts = get_children( $args );
	//echo '<pre>';print_r($posts);echo '</pre>';
		$args = array(
			'post_type' => 'attachment',
			'post_parent' => $_GET['post_parent'],
			'posts_per_page' => $_GET['posts_per_page']
		);

elseif($_GET['getPosts'] == 'category_name'):
		$args = array(
			'post_type' => $_GET['post_type'],
			'category_name' => $_GET['category_name'],
			'posts_per_page' => $_GET['posts_per_page']
		);
elseif($_GET['getPosts'] == 'featured'):
		$args = array(
			'p' => $_GET['post_ID']
		);
else:
		$args = array(
			'post_type' => $_GET['post_type'],
			'cat' => $_GET['cat'],
			'tag__and' => $_GET['tag__and'],
			'category_name' => $_GET['category_name'],
			'orderby' => $_GET['orderby'],
			'post_parent' => $_GET['post_parent'],
			'showposts' => $_GET['showposts'],
			'posts_per_page' => $_GET['posts_per_page'],
			'p' => $_GET['post_ID'],
			'post_name' => $_GET['post_name'],
			'paged' => $_GET['paged']
		);
endif;
$posts = get_posts($args);

$i=0;
//while (have_posts()): the_post();
foreach($posts as $post):
	setup_postdata($post);
	$fields = $cfs->get();
	if( has_post_thumbnail() ):
		$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
		$json_posts[$i]['image'] = $img[0];
	else:
		$attachments = get_children('post_parent='.$post->ID.'&posts_per_page=1');
		$img = wp_get_attachment_image_src(  $attachments[0]->ID, 'large');
		$json_posts[$i]['image'] = $img[0];
	endif;
	
	$json_posts[$i]['ID'] = $post->ID;
	$json_posts[$i]['excerpt'] = get_the_excerpt();
	$json_posts[$i]['permalink'] = get_permalink();
	$json_posts[$i]['title'] = get_the_title();
	//$json_posts[$i]['fields'] = $fields;
	if($fields):
		foreach ($fields as $key => $value):
			$json_posts[$i][$key] = $value;
		endforeach;
	endif;
	$i++;
//endwhile;
endforeach;




header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
echo json_encode($json_posts);
?>
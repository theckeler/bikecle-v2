<?
require_once ($_SERVER["DOCUMENT_ROOT"].'/wp-load.php');

if(!$_POST['paged']):
	$paged = 1;
else:
	$paged = $_POST['paged'];
endif;

if($_POST['post_name']):
	$post_name = $_POST['post_name'];
else:
	$post_name = $post->post_name;
endif;


if( $bike_gallery == 1 || $_POST['post_name'] ):
	
	$args = array(
		'tag' =>  $post_name,
		'showposts' => '8',
		'post_status' => 'publish',
		'orderby' => 'date',
		'category_name' =>  'gallery',
		'paged' => $paged
	);
else:
	$args = array(
		'post_type' => 'post',
		'cat' => '7,5',
		'orderby' => 'date',
		'post_status' => 'publish',
		'showposts' => '16',
		'paged' => $paged
	);
endif;
$gallery = new WP_Query($args); 

if( $gallery->have_posts() ):
	$i=1;
	$x=0;
?>
	<span class="hidden found_posts" id="<? echo $gallery->found_posts ?>"></span>
	<span class="hidden max_num_pages" id="<? echo $gallery->max_num_pages ?>"></span>
	<span class="hidden post_count" id="<? echo $gallery->post_count ?>"></span>
<?
	while ($gallery->have_posts()) : $gallery->the_post();
		$image = get_posts('post_type=attachment&post_parent='.$post->ID.'&post_mime_type=image&orderby=menu_order&order=ASC&numberposts=1'); 
		$image_thumb = image_downsize($image[0]->ID, 'medium');
?>
		<a href="<?php the_permalink() ?>" id="<? echo $post->post_name ?>" style="background-image: url('<? echo $image_thumb[0] ?>');"><p><? the_title() ?></p></a>
<?
		if($i > 0 && $i % 4 == 0) echo '<div class="gallery-open" id="gallery-open-'.$x.'"></div>';
		$i++;
		$x++;
	endwhile;
else:
?>
	<span class="hidden end-of-gallery"></span>
<?
endif;
?>
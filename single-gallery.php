<h1 class="single-title" id="gallery">Gallery</h1>
<div class="page">
<?
while (have_posts()):
	the_post();
	if ( in_category( 'gallery', $post->ID )):
		$content = strip_tags(get_the_content(), '<p><a><h2><blockquote><code><ul><li><i><em><strong>');
	else: 
		$content = get_the_content();
	endif;
?>
		<h2><?php the_title(); ?></h2>
		<div class="gallery-content"><?php echo $content; ?></div>
<?
	$images = get_posts('post_type=attachment&post_parent='.$post->ID.'&post_mime_type=image&orderby=menu_order&order=ASC&numberposts=-1'); 
	if(count($images) > 1):
		foreach($images as $image):
			//$full_image = $image->guid;
			$full_image = wp_get_attachment_image_src($image->ID, 'large');
			$image_thumb = image_downsize($image->ID, 'thumbnail');
?>
	<a rel="<? echo $post->ID ?>" class="fancybox gallery-thumbnail" href="<? echo $full_image[0] ?>">
		<img src="<? echo $image_thumb[0] ?>" border="0">
		<span>view</span>
	</a>
<?
		endforeach;
	else:
			$full_image = wp_get_attachment_image_src($images[0]->ID, 'full');
?>
	<img src="<? echo $full_image[0] ?>" class="gallery-full"  border="0" style="max-width: <? echo $full_image[1] ?>px">
<?
	endif;
endwhile;
?>
</div>
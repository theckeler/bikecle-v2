<?/* Template Name: Redirect */ ?>
<? get_header(); ?>

<?

$parent = new WP_Query('post_type=page&p='.$post->post_parent);
?>

<div id="content-change">
	<div class="container <? echo $post->post_name ?>" post_name="<? echo $post->post_name ?>">
<?
while ($parent->have_posts()): $parent->the_post();;
		//$fields = $cfs->get();
?>
		<h1><?php the_title(); ?></h1>
		<div class="content">
			<?php the_content(); ?>
		</div>
<?
	$children = get_pages('child_of='.$post->ID.'&sort_column=menu_order&order=asc');
	if(count( $children ) != 0):
		foreach($children as $post):
			setup_postdata($post);
?>
		<a name="<? echo $post->post_name ?>" id="<? echo $post->post_name ?>"></a>
		<h1><?php the_title(); ?></h1>
<?
		if ( has_post_thumbnail() ):
			the_post_thumbnail('medium');
		endif;
?>
		<div class="content">
			<?php the_content(); ?>
		</div>
<?
		endforeach;
	endif;
endwhile;
?>
	</div>
</div>
<?php //wp_redirect(get_permalink($post->post_parent)); exit; ?>

<? get_footer(); ?>
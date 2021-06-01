<?/* Template Name: Newsroom */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content newsroom">
	<h1 class="single-title" id="<? echo $post->post_name ?>">Newsroom</h1>
	<div class="page"><? the_content() ?></div>
	<div class="page">
<?
$posts = query_posts('post_type=newsroom&showposts=-1&orderby=date&order=DESC');
while( have_posts() ):
	the_post();
	$fields = CFS()->get();
?>
	<a href="<?php the_permalink(); ?>">
		
<?
	if ( has_post_thumbnail() ):
?>
		<div class="wp-caption alignleft">
			<? the_post_thumbnail('300-pixels'); ?>
			<p class="wp-caption-text"><? echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
		</div>
<?
	endif;
?>
		
		
		<h2><? the_title() ?></h2>
		<div class="newsroom-extras">
			<b>Source:</b> <? echo $fields['source'] ?>
			<br><b>Date:</b> <? echo date('F j, Y', strtotime($fields['date_of_article'])) ?>
			<br><b>URL:</b> <? echo get_permalink(); ?>
		</div>
		<? the_excerpt() ?>
	</a>
<?
endwhile;
?>
	</div>
</div>


<? get_footer(); ?>
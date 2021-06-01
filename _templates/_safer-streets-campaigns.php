<?/* Template Name: Safer Streets Campaigns */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content events-page safer-streets">
	<h1 class="single-title" id="<? echo $post->post_name ?>">Safer Streets Campaigns</h1>
	<div class="page"><? the_content() ?></div>
	<div class="page">
<?
//$news_sticky = query_posts('category_name=news-sticky&showposts=10&orderby=date');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$posts = query_posts('category_name=safer-streets-campaigns&showposts=8&orderby=date&paged='.$paged);
while( have_posts() ):
	the_post();
	$fields = CFS()->get();
?>
	<a href="<?php the_permalink(); ?>">
		<h2><? the_title() ?></h2>
		<? the_post_thumbnail('300-pixels'); ?>
		<? the_excerpt() ?>
	</a>
<?
endwhile;
?>
	</div>
	<div class="post-nav">
		<?php next_posts_link('&laquo; Older Entries') ?>
		<?php previous_posts_link('Newer Entries &raquo;') ?>
	</div>
</div>


<? get_footer(); ?>
<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content news-page">
	<h1 class="single-title" id="<? echo $post->post_name ?>">News</h1>
	<div class="page">
<?
//$news_sticky = query_posts('category_name=news-sticky&showposts=10&orderby=date');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$news_cats = get_news_cats();
$posts = query_posts('cat=5&showposts=8&orderby=date&paged='.$paged);
while( have_posts() ):
	the_post();
?>
	<a href="<?php the_permalink(); ?>" class="<? echo $add_CSS ?>">
		<div class="news-top">	
			<span class="news-date"><span><?php the_time('M') ?></span><span><?php the_time('d') ?></span><span><?php the_time('Y') ?></span></span>
			<div class="news-title"><? the_title() ?></div>
		</div>	
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
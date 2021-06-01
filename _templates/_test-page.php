<?/* Template Name: Test Page */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content staff-and-board">
	<h1 class="single-title" id="<? echo $post->post_name ?>">Test Page</h1>
	<div class="page">



<?php
$news_cats = get_news_cats();
print_r($news_cats);

$events_cats = get_events_cats();
print_r($events_cats);
?>






















	</div>

</div>


<? get_footer(); ?>
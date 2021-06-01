<?/* Template Name: Bike To Work Day */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content events-page">
	<h1 class="single-title" id="<? echo $post->post_name ?>">Bike To Work Day</h1>
	<div class="page"><? the_content() ?></div>
	<div class="page">
<?
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//$posts = query_posts('category_name=bike-to-work-day&showposts=8&orderby=date&paged='.$paged);
$args=array(
   'category_name' => 'bike-to-work-day',
   'showposts' => -1,
   'meta_key' => 'event_start_time',
   'meta_compare' => '>',
   'meta_value' => $today,
   'orderby' => 'event_start_time',
   'paged' => $paged
);
$events = new WP_Query($args);
while( $events->have_posts() ):
	$events->the_post();
	$fields = CFS()->get();
?>
	<a href="<?php the_permalink(); ?>">
		<h2><? the_title() ?></h2>
		<? the_post_thumbnail('medium'); ?>
		<? the_excerpt() ?>
	</a>
<?
endwhile;
?>
	</div>
	<div class="post-nav">
		<?php next_posts_link('&laquo; Older Entries', $events->max_num_pages) ?>
		<?php previous_posts_link('Newer Entries &raquo;') ?>
	</div>
</div>


<? get_footer(); ?>
<? get_header(); ?>

<? add_back_IMG() ?>

<?php
global $wp_query;
?>

<div class="content search-page <? echo $post->post_name ?>">
	<h1 class="single-title" id="<? echo $post->post_name ?>">Search, Number of Results: <? echo $wp_query->found_posts; ?></h1>
	<div class="page">
<?
if ( have_posts() ) :
	while (have_posts()): the_post();
		$fields = CFS()->get();
?>
	<span>
		<a class="search-title" href="<?php the_permalink(); ?>"><? the_title() ?></a>
		<div><?php the_category(', '); ?></div>
		<? the_excerpt() ?>
<?
		if( !empty($fields['event_start_date']) ):
?>
			<div class="events-time">
				Date: <?php echo date('M d, Y', strtotime($fields['event_start_date'])); ?>
<?
			if( ( $fields['event_start_date'] != $fields['event_end_date'] ) && ( !empty($fields['event_end_date']) )):
?>
				&nbsp;- <?php echo date('M d, Y', strtotime($fields['event_end_date'])); ?>
<?
			endif;
?>
				<br>Time: <?php echo $fields['event_start_time']; ?> <?php if($fields['event_end_time']): echo ' - ' . $fields['event_end_time']; endif; ?>
			</div>
<?
		endif;
?>
	</span>
<?
	endwhile;
else:
?>
		Sorry there are no results.
<?
endif;
?>
	</div>
	<div class="post-nav">
		<?php next_posts_link('&laquo; Older Entries') ?>
		<?php previous_posts_link('Newer Entries &raquo;') ?>
	</div>
</div>
	
<? get_footer(); ?>
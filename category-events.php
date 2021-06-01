<? get_header(); ?>

<? add_back_IMG(); ?>

<?
$today = date("Y-m-d");
$args=array(
   'category_name' => 'events',
   'posts_per_page' => 4,
   'showposts' => 4,
   'meta_key' => 'event_start_date',
   'meta_compare' => '>=',
   'meta_value' => $today,
   'orderby' => 'event_start_date',
   'paged' => $paged,
   'order' => 'ASC'
);

$events = new WP_Query($args);
if($events->have_posts()):
?>
<div class="content events">
	<h1>Events</h1>
<?
	while( $events->have_posts() ):
		$events->the_post();
		$fields = CFS()->get();
		$end_time = ($fields['event_end_time'] ? '-'.$fields['event_end_time'] : '' );
		$time = ($fields['event_start_time'] ? '<p>Time: '.$fields['event_start_time'].$end_time.'</p>' : '' );
?>
	<a href="<?php the_permalink(); ?>" class="<? echo $add_CSS ?>">
		<div class="event-title"><? the_title() ?></div>
		<? the_excerpt() ?>
<?
		if( !empty($fields['event_start_date']) ):
?>
			<div class="events-time">
				<p>Date: <?php echo date('D n/j/y', strtotime($fields['event_start_date'])); ?>
<?
			if( ( $fields['event_start_date'] != $fields['event_end_date'] ) && ( !empty($fields['event_end_date']) )):
?>
				-<?php echo date('D n/j/y', strtotime($fields['event_end_date'])); ?>
<?
			endif;
?>
				</p>
				<? echo $time ?>
			</div>
<?
		endif;
?>
	</a>
<?
	endwhile;
?>
</div>
<?
endif;
?>


<? get_footer(); ?>
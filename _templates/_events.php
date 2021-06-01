<?/* Template Name: Events */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content events-page">
	<h1 class="single-title" id="cycling-events-calendar">Events</h1>
</div>

<a name="bike-cle-events"></a>
<div class="content events-page">
	<h2 class="single-title" id="<? echo $post->post_name ?>">Bike Cleveland Events</h2>
	<div class="page">
<?
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$events_cats = get_events_cats();
$today = date("Y-m-d");
$args=array(
   'cat' => 43,
   'posts_per_page' => 4,
   'showposts' => 8,
   'meta_key' => 'event_start_date',
   'meta_compare' => '>=',
   'meta_value' => $today,
   'orderby' => 'event_start_date',
   'paged' => $paged,
   'order' => 'ASC'
);
$events = new WP_Query($args);
while( $events->have_posts() ):
	$events->the_post();
	$fields = CFS()->get();
	//echo '<pre>'.print_r($fields, true).'</pre>';
?>
	<a href="<?php the_permalink(); ?>" class="<? echo $add_CSS ?>">
		<? echo '<pre>'.print_r($fields, true).'</pre>'; ?>
		<div class="news-top">	
			<div class="news-title"><? the_title() ?></div>
		</div>	
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
			if( !empty($fields['event_start_time']) ):
?>
				<br>Time: <?php echo $fields['event_start_time']; ?> <?php if($fields['event_end_time']): echo ' - ' . $fields['event_end_time']; endif; ?>
<?
			endif;
?>
			</div>
<?
		endif;
?>
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

<a name="cycling-events"></a>
<div class="content events-page">
	<h2 class="single-title" id="cycling-events-calendar">Cycling Events Calendar</h2>

	<h3>Looking for cycling events across Greater Cleveland?</h3>
	This calendar shows Bike Cleveland events as well as other cycling related activities taking place across greater Cleveland.

	Are you planning a cycling workshop, neighborhood ride, or other cycling activity. Let us know! We will add it. To get your cycling event on this calendar <a href="http://goo.gl/forms/ws0DZiultF" target="_blank" rel="noopener">click here</a>.
	<iframe style="border-width: 0;" src="https://www.google.com/calendar/embed?showTitle=0&amp;mode=AGENDA&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=s64qrm82g7mbo8pc62dj74tf9o%40group.calendar.google.com&amp;color=%23691426&amp;ctz=America%2FNew_York" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
</div>

<? get_footer(); ?>
<?
while (have_posts()):
	the_post();
	$fields = CFS()->get();
?>
		<div class="page-subnav"><a href="/">Home</a> &#187; <a href="/events/">Events</a></div>
		<h1 class="single-title" id="<? echo $post->post_name ?>">
			<?php the_title(); ?>
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
		</h1>
		<div class="page"><?php the_content(); ?></div>
<?
endwhile;
?>
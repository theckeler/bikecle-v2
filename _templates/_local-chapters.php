<?/* Template Name: Local Chapters */ ?>

<? get_header(); ?>

<? add_back_IMG() ?>

<?
$post_sluggin = CFS()->get();
?>

<div class="content chapter-page">
	<h1 class="single-title"><?php echo get_the_title( $post->ID ); ?></h1>
	<div class="page">
		<? the_post_thumbnail('300-pixels', array( 'class' => 'alignleft' )); ?><? the_content() ?>
	</div>
</div>

<?
$posts = query_posts('category_name='.$post_sluggin['news_slug'].'&showposts=4&orderby=date');
if ( have_posts() ) :
?>
<div class="content news-page">
	<h1 class="single-title"><?php echo get_the_title( $post->ID ); ?> News</h1>
	<div class="page">
<?
	while( have_posts() ):
		the_post();
		$fields = CFS()->get();
?>
	<a href="<?php the_permalink(); ?>">
		<div class="news-top">	
			<span class="news-date"><span><?php the_time('M') ?></span><span><?php the_time('d') ?></span><span><?php the_time('Y') ?></span></span>
			<div class="news-title"><? the_title() ?></div>
		</div>	
		<? the_excerpt() ?>
	</a>
<?
	endwhile;
	wp_reset_query();
?>
	</div>
</div>
<?
endif;

$posts = query_posts('category_name='.$post_sluggin['events_slug'].'&showposts=4&orderby=date&paged='.$paged);
if ( have_posts() ) :
?>
<div class="content events-page">
	<h1 class="single-title"><?php echo get_the_title( $post->ID ); ?> Events</h1>
	<div class="page">
<?
	while( have_posts() ):
		the_post();
		$fields = CFS()->get();
?>
	<a href="<?php the_permalink(); ?>">
		<div class="news-top">	
			<span class="news-date"><span><?php the_time('M') ?></span><span><?php the_time('d') ?></span><span><?php the_time('Y') ?></span></span>
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
?>
				<br>Time: <?php echo $fields['event_start_time']; ?> <?php if($fields['event_end_time']): echo ' - ' . $fields['event_end_time']; endif; ?>
			</div>
<?
		endif;
?>
	</a>
<?
	endwhile;
	wp_reset_query();
?>
	</div>
</div>
<?
endif;
?>

<div class="content chapter-page">
	<div class="page">
		<? echo $post_sluggin['more_info'] ?>
	</div>
</div>

<? get_footer(); ?>
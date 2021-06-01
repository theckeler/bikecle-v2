<?/* Template Name: Home - Drivers */ ?>

<? $headerlock = 1; get_header(); ?>

<?
$args = array(
	'post_type' => 'alldrivers',
	'posts_per_page' => 1,
	'orderby'=> 'rand',
	'tax_query' => array(
		array(
			'key' => 'alldrivers_type',
			'value' => 'campaign',
			'compare' => '=='
		)
	)
);
$the_query = new WP_Query( $args );

while ($the_query->have_posts()):
	$the_query->the_post();
	$fields = CFS()->get();

		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $get_image_size );
		$style = ( $image[0] ? 'style="background-image: url('.$image[0].');"' : '' );
?>
		<a id="yt-vid" href="/alldrivers/" class="content all-drivers-img all-drivers-home" <? echo $style ?>>
			<div><? the_title(); ?></div>
			<div><b>We're all drivers...</b><p><? echo $fields[bio]; ?></p></div>
		</a>
<?
endwhile;
wp_reset_query();
?>

<div class="content news">
	<h1>News</h1>
<?
$news_cats = get_news_cats();
$posts = query_posts('cat='.$news_cats.'&showposts=4&orderby=date&paged='.$paged);
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

<div class="content home-links">
<?
	$posts = new WP_Query('post_type=home_icons&showposts=-1&orderby=menu_order&order=ASC');
	while ($posts->have_posts()):
		$posts->the_post();
		$images = get_posts('post_type=attachment&post_parent='.$post->ID.'&orderby=menu_order&order=ASC&numberposts=1'); 
?>
	<a href="<?php the_permalink(); ?>">
		<img src="<? echo $images[0]->guid ?>">
		<h2><? the_title() ?></h2>
		<? the_content() ?>
	</a>
<?
	endwhile;
?>
</div>

<div class="content events">
	<h1>Events</h1>
<?
$events_cats = get_events_cats();
$today = date('Y-m-j');

$args=array(
	'cat' => $events_cats,
	'posts_per_page' => 4,
	'meta_key' => 'event_start_date',
	'meta_compare' => '>',
	'meta_value' => $today,
	'orderby' => 'event_start_date',
	'order' => 'ASC',
	'paged' => $paged
);
$events = new WP_Query($args);
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

<div class="content sponsors-home">
	<h1>Sponsors & Supporters</h1>
	<div class="sponsors">
<?
	$posts = new WP_Query('taxonomy=sponsors_supporters_type&term=sponsor&showposts=-1&post_type=sponsors_supporters&orderby=menu_order');
	while ($posts->have_posts()):
		$posts->the_post();
?>
		<a href="<?php the_permalink(); ?>" target="_new"><?php the_post_thumbnail( 'sponsor-size' ); ?></a>
<?
	endwhile;
?>
	</div>
	<div class="supporters">
<?
	$posts = new WP_Query('taxonomy=sponsors_supporters_type&term=supporter&showposts=-1&post_type=sponsors_supporters&orderby=menu_order');
	while ($posts->have_posts()):
		$posts->the_post();
?>
		<a href="<?php the_permalink(); ?>" target="_new"><?php the_post_thumbnail( 'supporter-size' ); ?></a>
<?
	endwhile;
?>
	</div>
</div>

<? get_footer(); ?>
<? get_header(); ?>

<? add_back_IMG() ?>

<div class="content single-page <? echo $post->post_name ?>">
	<h1 class="single-title" id="<? echo $post->post_name ?>"><? echo $post->post_title ?></h1>
<?
while (have_posts()): the_post();
	$fields = CFS()->get();
//	print_r($fields);
	if($fields['add_calendar'] || $fields['add_news'] || $fields['add_donate']):
?>
	<div class="page page-with-columns">
		<span class="left-side">
			<?php the_content(); ?>
		</span>
		<span class="right-side">
<?
		if($fields['add_calendar'] == 'sdkjasdjasd'):
?>
			<h2>Calendar</h2>
			<? echo do_shortcode( '[gcal id="6370"]' ); ?>
<?
		endif;
		if($fields['add_news']):
?>
			<h2>News</h2>
<?
			$news_sticky = query_posts('category_name=news-sticky&showposts=4&orderby=date');
			$news = query_posts('category_name=news&cat=-51&showposts=4&orderby=date');
			$posts = array_merge($news_sticky, $news);
		
			$i=0;
			foreach ($posts as $post):
				setup_postdata($post);
				if ( in_category( 'news-sticky' )):
					$add_CSS = 'sticky';
				else:
					$add_CSS = '';
				endif;
?>
	<a href="<?php the_permalink(); ?>" class="right-side-news <? echo $add_CSS ?>"><? the_title() ?></a>
<?
			$i++;
			if($i == 4) { break; };
			endforeach;
			wp_reset_query();
		endif;
		if($fields['add_donate']):
?>
			<h2>Donate</h2>
			<h3>Donate Online</h3>
			<p><a href="http://bikecleveland.memberlodge.org/donate" target="_new"><img src="http://v1.bikecleveland.org/wp-content/uploads/2015/03/icon-donate1.png"></a></p>
			
			<h3>Donate by Mail</h3>
			<p>If you would rather not donate online you can opt to send us a check or money order.
			<br>Make checks payable to Bike Cleveland and send it to:
			<br>Bike Cleveland
			<br>PO Box 609718
			<br>Cleveland, OH 44109</p>
<?
		endif;
?>
		</span>
	</div>
<?
	else:
?>
	<div class="page">
		<?php the_content(); ?>
	</div>
<?
	endif;
endwhile;
?>
</div>
	
<? get_footer(); ?>
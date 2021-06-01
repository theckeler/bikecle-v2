<?/* Template Name: Staff and Board of Directors */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content staff-and-board expander">
	<h1 class="single-title" id="<? echo $post->post_name ?>">Staff and Board of Directors</h1>
	<div class="page">
<?

$post_query[0] = new WP_Query('post_type=staff_and_board&staff_or_board=staff&showposts=-1&orderby=menu_order&order=ASC');
$post_query[1] = new WP_Query('post_type=staff_and_board&staff_or_board=board-of-directors&showposts=-1&orderby=menu_order&order=ASC');


foreach ($post_query as &$posts):
	while ($posts->have_posts()):
		$posts->the_post();
		$fields = CFS()->get();
		$terms = wp_get_post_terms( $post->ID, 'staff_or_board' );
		if($page_title != $terms[0]->name):
?>
	<h2><? echo $terms[0]->name ?></h2>
<?		
			$page_title = $terms[0]->name;
		endif;
?>
	<div class="<? if($fields['hide_it']): echo 'expander-hide'; endif ?>">
		<h3><? the_title() ?><? if($fields['title']): echo ', '.$fields['title']; endif ?></h3>
		<div>
			<? the_post_thumbnail('300-pixels', array( 'class' => 'alignright' )); ?>
			<? the_content() ?>
		</div>
	</div>
<?
	endwhile;
endforeach;
?>

	</div>

</div>


<? get_footer(); ?>
<?/* Template Name: Home */ ?>

<? get_header(); ?>

<?
while (have_posts()) : the_post();
	$fields = $cfs->get();
?>
	<?php the_content(); ?>
<?
endwhile;
?>

<div class="content sponsors-home max-width">
	<h1>Sponsors & Supporters</h1>
	<div class="sponsors">
		<?
		$posts = new WP_Query('taxonomy=sponsors_supporters_type&term=sponsor&showposts=-1&post_type=sponsors_supporters&orderby=menu_order');
		while ($posts->have_posts()) :
			$posts->the_post();
		?>
			<a href="<?php the_permalink(); ?>" target="_new"><?php the_post_thumbnail('sponsor-size'); ?></a>
		<?
		endwhile;
		?>
	</div>
	<div class="supporters">
		<?
		$posts = new WP_Query('taxonomy=sponsors_supporters_type&term=supporter&showposts=-1&post_type=sponsors_supporters&orderby=menu_order');
		while ($posts->have_posts()) :
			$posts->the_post();
		?>
			<a href="<?php the_permalink(); ?>" target="_new"><?php the_post_thumbnail('supporter-size'); ?></a>
		<?
		endwhile;
		?>
	</div>
</div>

<? get_footer(); ?>
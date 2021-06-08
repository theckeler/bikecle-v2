<?/* Template Name: Home */ ?>

<? get_header(); ?>

<div class="content page-top hero-img img-id-">
	<a class="ten-year-button" href="/10years/"><img src="https://www.bikecleveland.org/wp-content/uploads/2021/06/BC-LandingPage-Banner-1920x240-Vector-button.svg" class="attachment-full size-full" alt="" loading="lazy"></a>
	<?php echo wp_get_attachment_image(8545, 'full'); ?>
</div>


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
<?/* Template Name: All Drivers Submit */ ?>

<?php get_header(); ?> 

<? add_back_IMG() ?>

<div class="content events-page">
	<h1 class="single-title" id="<? echo $post->post_name ?>"><? the_title() ?></h1>
	<div class="page">
	
<?
if( $_POST ):
	all_drivers_upload();
else:

	all_drivers_form();

endif;
?>
	
	
	
	
	</div>
</div>


<? get_footer(); ?>
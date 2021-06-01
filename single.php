<?
get_header();

add_back_IMG();
?>
<div class="content single-post <? echo $post->post_name ?>" id="content-change">
<?
if(in_category('safer-streets-campaigns')):
	include('single-safer-streets-campaigns.php');

elseif(in_category('events')):
	include('single-events.php');

elseif(in_category('news')):
	include('single-news.php');

else:
	include('single-default.php');
endif;
?>
	<div class="post-nav">
		<?php previous_post_link('%link', '&laquo; %title', $in_same_cat = true, $excluded_categories = ''); ?>
		<?php next_post_link('%link', '%title &raquo;', $in_same_cat = true, $excluded_categories = ''); ?>
	</div>
</div>
<?
get_footer();
?>
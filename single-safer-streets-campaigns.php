<?
while (have_posts()):
	the_post();
	$fields = CFS()->get();
?>
		<div class="page-subnav"><a href="/">Home</a> &#187; <a href="/our-work/">Our Work</a> &#187; <a href="/our-work/safer-streets-campaigns/">Safer Streets Campaigns</a></div>
		<h1 class="single-title subnav-title" id="<? echo $post->post_name ?>"><?php the_title(); ?></h1>
		<div class="page safer-streets-campaign"><?php the_content(); ?></div>
<?
endwhile;
?>

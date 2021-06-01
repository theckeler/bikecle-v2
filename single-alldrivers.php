<? $headerlock = 1; get_header(); ?>

<?
$get_image_size = ( wp_is_mobile() ? 'medium' : 'large' );
while (have_posts()):
	the_post();
	$fields = CFS()->get();
	if( $fields['youtube_video_id']  && !wp_is_mobile() ):
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
	$('#module-video').YTPlayer({
		fitToBackground: false,
		videoId: '<? echo $fields[youtube_video_id] ?>',
		pauseOnScroll: false,
		width: '100%',
		repeat: false,
		mute: false,
		playerVars: {
			modestbranding: 0,
			autoplay: 1,
			controls: 0,
			showinfo: 0,
			wmode: 'transparent',
			branding: 0,
			rel: 0,
			autohide: 0,
			origin: window.location.origin
		  }
	});
});
</script>
		<div class="content all-drivers-vid">
			<span id="module-video" class="module-video"></span>
		</div>
		<div class="page all-drivers">
			<div class="content">
				<h1 class="single-title video-title" id="gallery"><? the_title() ?></h1>
				<? the_content() ?>
			</div>
		</div>
<?
	else:
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $get_image_size );
		$style = ( $image[0] ? 'style="background-image: url('.$image[0].');"' : '' );
?>
		<div id="yt-vid" class="content all-drivers-img" <? echo $style ?>>
			<div><? the_title(); ?></div>
			<div><b>We're all drivers...</b><p><? echo $fields[bio]; ?></p></div>
		</div>
		<div class="page all-drivers">
			<div class="content"><? the_content() ?></div>
		</div>
<?
	endif;
endwhile;
?>


<? get_footer(); ?>
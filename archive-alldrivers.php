<? get_header(); ?>

<? add_back_IMG(); ?>

<div class="page all-drivers-archive">
	<h2 class="single-title" id="<? echo $post->post_name ?>">We're All Drivers</h2>
<?
	$post = get_page('7371');
?>
	<div class="content"><? echo apply_filters('the_content', $post->post_content); wp_reset_query(); ?></div>

<?
$get_image_size = ( wp_is_mobile() ? 'medium' : 'large' );

$args = array(
	'post_type' => 'alldrivers',
	'posts_per_page' => -1,
	'orderby'=> 'menu_order',
	'order'=>'ASC',
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

	if( $fields['youtube_video_id'] && !wp_is_mobile() ):
?>
<script type='text/javascript'>
jQuery(document).ready(function($) {
	var getThis = $('#<? echo $post->ID ?>');
	
	getThis.YTPlayer({
		fitToBackground: false,
		videoId: '<? echo $fields[youtube_video_id] ?>',
		pauseOnScroll: false,
		width: '100%',
		mute: true,
		repeat: false,
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
		},
		events: {
			'onStateChange': onPlayerStateChange
		}
	});
	
	
	
	function onPlayerStateChange(event) {        
            if(event.data === 0) {          
				//console.log("playerFinshed: "+getThis.attr('ID'));
				getThis.find('.hide-me').fadeTo(400,1);
				getThis.find('iframe').remove();
            }
        }
	
});
</script>
		<a id="<? echo $post->ID ?>" href="<?php the_permalink(); ?>" style="background-image: url(<? echo $image[0] ?>);" class="drivers-vid"><span class="drivers-cover-vid"></span><span class="hide-me"><? the_title(); ?></span></a>
<?
	else:
?>
		<a href="<?php the_permalink(); ?>" style="background-image: url(<? echo $image[0] ?>);"><span><? the_title(); ?></span></a>
<?
	endif;
endwhile;
?>
</div>

<? get_footer(); ?>
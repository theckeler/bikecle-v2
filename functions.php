<?
add_theme_support('woocommerce');

function remove_menus()
{
	remove_menu_page('edit-comments.php');
	if (!current_user_can('manage_options')) :
		remove_menu_page('tools.php');
		remove_menu_page('edit.php?post_type=gce_feed');
		remove_menu_page('edit.php?post_type=sponsors_supporters');
		remove_menu_page('edit.php?post_type=home_images');
		remove_menu_page('edit.php?post_type=home_icons');
		remove_menu_page('edit.php?post_type=staff_and_board');
		remove_menu_page('edit.php?post_type=newsroom');
		remove_menu_page('edit.php?page=dk_speakup');
		remove_menu_page('edit.php?post_type=page');
		remove_menu_page('edit.php?post_type=bikeindex_bike');


	endif;
}
add_action('admin_menu', 'remove_menus');
add_filter('show_admin_bar', '__return_false');

function enable_more_buttons($buttons)
{
	$buttons[] = 'hr';
	return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");

function get_news_cats()
{
	$categories = get_categories('orderby=name&order=ASC&hide_empty=0');
	foreach ($categories as $category) :
		if (strstr($category->slug, 'news')) :
			$news_cats .= ',' . $category->term_id;
		endif;
	endforeach;
	return $news_cats;
}

add_filter('use_default_gallery_style', '__return_false');


function get_events_cats()
{
	$categories = get_categories('orderby=name&order=ASC&hide_empty=0');
	foreach ($categories as $category) :
		if (strstr($category->slug, 'events')) :
			$events_cats .= ',' . $category->term_id;
		endif;
	endforeach;
	return $events_cats;
}

function frontend_load_scripts()
{

	wp_deregister_script('jquery');

	wp_enqueue_script('jquery', get_bloginfo('template_directory') . '/_js-plugins/jquery-2.1.0.min.js', '', NULL, false);
	wp_enqueue_script('mobile', get_bloginfo('template_directory') . '/_js-plugins/jquery.mobile.custom.min.js', '', NULL, false);
	wp_enqueue_script('fancybox-js', get_bloginfo('template_directory') . '/_js-plugins/fancybox/source/jquery.fancybox.pack.js', '', NULL, false);
	wp_enqueue_style('fancybox-css', get_bloginfo('template_directory') . '>/_js-plugins/fancybox/source/jquery.fancybox.css', '', NULL, false);
	wp_enqueue_script('youtubebackground', get_bloginfo('template_directory') . '>/_js-plugins/jquery.youtubebackground.js', '', NULL, false);

	wp_enqueue_style('css', get_bloginfo('template_directory') . '/style.css', '', NULL, false);
	wp_enqueue_script('main', get_bloginfo('template_directory') . '/_js/main.js', '', NULL, false);
	/*
	if ( function_exists( 'is_woocommerce' ) ):
		if ( ! is_woocommerce() && ! is_cart() && ! is_checkout() ):
			wp_dequeue_style( 'woocommerce_frontend_styles' );
			wp_dequeue_style( 'woocommerce_fancybox_styles' );
			wp_dequeue_style( 'woocommerce_chosen_styles' );
			wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
			wp_dequeue_script( 'wc_price_slider' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'wc-cart-fragments' );
			wp_dequeue_script( 'wc-checkout' );
			wp_dequeue_script( 'wc-add-to-cart-variation' );
			wp_dequeue_script( 'wc-single-product' );
			wp_dequeue_script( 'wc-cart' );
			wp_dequeue_script( 'wc-chosen' );
			wp_dequeue_script( 'woocommerce' );
			wp_dequeue_script( 'prettyPhoto' );
			wp_dequeue_script( 'prettyPhoto-init' );
			wp_dequeue_script( 'jquery-blockui' );
			wp_dequeue_script( 'jquery-placeholder' );
			wp_dequeue_script( 'fancybox' );
			wp_dequeue_script( 'jqueryui' );
		endif;
	endif;
*/

	wp_dequeue_style('columns');
	wp_dequeue_style('frontend-uploader-css');
}
add_action('wp_enqueue_scripts', 'frontend_load_scripts', 99999);

add_theme_support('post-thumbnails', array('post', 'page', 'sponsors_supporters', 'home_images', 'staff_and_board', 'product', 'newsroom', 'alldrivers'));
add_image_size('sponsor-size', 170);
add_image_size('supporter-size', 80);
add_image_size('300-pixels', 300);

function remove_page_excerpt_field()
{
	remove_meta_box('page-links-to', 'home_images', 'advanced');
	remove_meta_box('formatdiv', 'post', 'side');

	remove_post_type_support('product', 'editor');

	remove_meta_box('postimagediv', 'home_images', 'side');
	add_meta_box('postimagediv', __('Custom Image'), 'post_thumbnail_meta_box', 'home_images', 'normal', 'high');
}
add_action('do_meta_boxes', 'remove_page_excerpt_field');


add_filter('manage_edit-sponsors_supporters_columns', 'add_new_gallery_columns');
function add_new_gallery_columns($gallery_columns)
{
	$new_columns['cb'] = '<input type="checkbox" />';
	$new_columns['title'] = _x('Name', 'column name');

	$new_columns['categories'] = __('Categories');
	$new_columns['menu_order'] = 'Order';

	$new_columns['date'] = _x('Date', 'column name');

	return $new_columns;
}

function show_order_column($name)
{
	global $post;

	switch ($name) {
		case 'menu_order':
			$order = $post->menu_order;
			echo $order;
			break;
		default:
			break;
	}
}
add_action('manage_header_text_posts_custom_column', 'show_order_column');

function order_column_register_sortable($columns)
{
	$columns['menu_order'] = 'menu_order';
	return $columns;
}
add_filter('manage_edit-header_text_sortable_columns', 'order_column_register_sortable');


function change_gce_prev($prev)
{
	return '&laquo; ' . $prev;
}
add_filter('gce_prev_text', 'change_gce_prev');

function change_gce_next($next)
{
	return $next . ' &raquo;';
}
add_filter('gce_next_text', 'change_gce_next');



function add_social_buttons()
{

	$string = '
			<a href="https://twitter.com/bike_cle" class="social-button social-tw" target="_new">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="-0.852 -0.099 91 63" enable-background="new -0.852 -0.099 91 63" xml:space="preserve">
					<path d="M79.806,27.564c5.055-0.417,8.48-2.715,9.803-5.833c-1.824,1.12-7.486,2.341-10.611,1.178 c-0.154-0.734-0.324-1.432-0.492-2.062C76.123,12.102,67.968,5.056,59.423,5.906c0.693-0.279,1.395-0.539,2.094-0.772 c0.938-0.337,6.459-1.235,5.59-3.183c-0.736-1.713-7.477,1.295-8.744,1.688C60.037,3.01,62.81,1.926,63.107,0 c-2.57,0.352-5.088,1.566-7.035,3.331c0.703-0.757,1.236-1.679,1.348-2.672c-6.848,4.374-10.848,13.193-14.085,21.749 c-2.543-2.463-4.795-4.403-6.815-5.48c-5.67-3.041-12.449-6.213-23.093-10.164c-0.325,3.521,1.742,8.203,7.699,11.316 c-1.291-0.173-3.649,0.213-5.539,0.665c0.771,4.034,3.28,7.357,10.08,8.964c-3.106,0.205-4.713,0.912-6.168,2.436 c1.414,2.805,4.868,6.108,11.078,5.429c-6.904,2.977-2.814,8.49,2.805,7.667C23.795,53.143,8.681,52.416,0,44.134 c22.662,30.879,71.921,18.262,79.261-11.481c5.5,0.047,8.734-1.905,10.738-4.057C86.832,29.134,82.242,28.578,79.806,27.564"/>
				</svg>
			</a>
			<a href="https://www.facebook.com/bikecleveland" class="social-button" target="_new">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="-0.244 -0.633 91 91" enable-background="new -0.244 -0.633 91 91" xml:space="preserve">
					<path d="M90,15.001C90,7.119,82.885,0,75,0H15.002C7.115,0,0,7.119,0,15.001V75c0,7.881,7.115,15,15.002,15H45V56H34V41h11v-5.844 C45,25.077,52.569,16,61.875,16H74v15H61.875C60.549,31,59,32.611,59,35.024V41h15v15H59v34h16c7.885,0,15-7.119,15-15V15.001z"/>
				</svg>
			</a>
			<a href="https://instagram.com/bike_cle/" class="social-button social-instagram" target="_new">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/" x="0px" y="0px" viewBox="-0.684 -0.896 398 402" enable-background="new -0.684 -0.896 398 402" xml:space="preserve">
					<path d="M346.607,0H50.027C22.396,0,0,22.396,0,50.027v300.155c0,27.63,22.396,50.025,50.027,50.025h296.581 c27.629,0,50.025-22.396,50.025-50.025V50.027C396.633,22.396,374.236,0,346.607,0 M279.915,200.103 c0,44.995-36.606,81.602-81.598,81.602c-44.998,0-81.606-36.606-81.606-81.602c0-13.531,3.36-26.267,9.211-37.519 c13.613-26.156,40.926-44.086,72.395-44.086c31.46,0,58.777,17.93,72.385,44.086C276.551,173.836,279.915,186.572,279.915,200.103 M351.966,335.036c0,11.327-9.185,20.505-20.503,20.505H66.956c-11.323,0-20.504-9.178-20.504-20.505V162.583h33.831 c-3.772,11.844-5.84,24.441-5.84,37.519c0,68.306,55.567,123.872,123.874,123.872c68.302,0,123.87-55.566,123.87-123.872 c0-13.078-2.073-25.675-5.842-37.519h35.621V335.036z M351.966,98.014c0,11.321-9.185,20.506-20.503,20.506h-31.059 c-11.32,0-20.502-9.185-20.502-20.506V64.123c0-8.987,5.826-16.546,13.881-19.31h37.68c11.318,0,20.503,9.179,20.503,20.506V98.014z"/>
				</svg>
			</a>
			';
	return $string;
}
add_shortcode('add_social_media_buttons', 'add_social_buttons');

function add_back_IMG($post)
{


	if ($post->ID == 11183) :
		$fullImage = wp_get_attachment_image(11195, 'full', '', array('class' => 'desktop'));
		$medImage = wp_get_attachment_image(11200, 'full', '', array('class' => 'mobile'));
	else :
		$posts = new WP_Query('post_type=home_images&showposts=1&orderby=rand');
		while ($posts->have_posts()) :
			$posts->the_post();
			$button = '<a class="ten-year-button" href="/10years/">' . wp_get_attachment_image(11201, 'full') . '</a>';
			$randImg = get_post_thumbnail_id($posts->ID);
			$fullImage = wp_get_attachment_image($randImg, 'full', '', array('class' => 'desktop'));
			$medImage = wp_get_attachment_image($randImg, 'medium', '', array('class' => 'mobile'));
		endwhile;
	endif;
?>
	<div class="content page-top hero-img img-id-<?php echo $post->ID ?>">
		<?php echo $button ?>
		<?php echo $fullImage ?>
		<?php echo $medImage ?>
	</div>
<?
	wp_reset_query();
}

add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1()
{
	return 'class="prev-post"';
}
function posts_link_attributes_2()
{
	return 'class="next-post"';
}

function add_class_next_post_link($html)
{
	$html = str_replace('<a', '<a class="next-post"', $html);
	return $html;
}
add_filter('next_post_link', 'add_class_next_post_link', 10, 1);

function add_class_previous_post_link($html)
{
	$html = str_replace('<a', '<a class="prev-post"', $html);
	return $html;
}
add_filter('previous_post_link', 'add_class_previous_post_link', 10, 1);

function register_my_menus()
{
	register_nav_menus();
}
add_action('init', 'register_my_menus');

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

update_option('image_default_link_type', 'file');

function my_gallery_default_type_set_link($settings)
{
	$settings['galleryDefaults']['link'] = 'file';
	return $settings;
}
add_filter('media_view_settings', 'my_gallery_default_type_set_link');

function amethyst_gallery_atts($out, $pairs, $atts)
{
	$out['columns'] = 4;
	$out['size'] = 'thumbnail';
	$out['link'] = 'file';
	return $out;
}
add_filter('shortcode_atts_gallery', 'amethyst_gallery_atts', 10, 3);

function centerme_shortcode($atts, $content = null)
{
	return '<span class="center-me">' . $content . '</span>';
}
add_shortcode('centerMe', 'centerme_shortcode');

add_filter('loop_shop_per_page', create_function('$cols', 'return -1;'), 20);

function faqs_shortcode($atts)
{
	$faqs_type = $atts['faqs_category'];

	$args = array(
		'post_type'   => 'faqs',
		'tax_query' => array(
			array(
				'taxonomy' => 'faqs_type',
				'field' => 'slug',
				'terms' => $faqs_type
			)
		),
		'showposts'   => -1,
		'orderby'   => 'menu_order',
	);

	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) :

		$return_me = '<div class="expander">';


		while ($the_query->have_posts()) :
			$the_query->the_post();

			$return_me .= '<div class="expander-hide"><h3>' . get_the_title() . '</h3><div>' . get_the_content() . '</div></div>';

		endwhile;
	endif;
	$return_me .= '</div>';

	return $return_me;
}
add_shortcode('add_faqs', 'faqs_shortcode');



include('_functions/woo.php');
include('_functions/alldrivers.php');
include('_functions/shortcodes.php');
include('_functions/media.php');
include('_functions/post-types.php');
include('_functions/local.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//Dli XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/Dli/xhtml1-transitional.dli">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php bloginfo('name'); ?> | <?php bloginfo('description'); ?> <?php wp_title('|', true, 'left'); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="title" content="<?php bloginfo('name'); ?> <?php bloginfo('description'); ?> <?php wp_title('|', true, 'left'); ?>" />
	<meta name="description" content="" />
	<meta name="robots" content="INDEX, FOLLOW" />
	<meta name="revisit-after" content="15 days" />

	<meta name="document-class" content="Completed" />
	<meta name="document-rights" content="Copyrighted Work" />
	<meta name="document-type" content="Public" />
	<meta name="document-rating" content="General" />
	<meta name="document-distribution" content="Global" />
	<meta name="document-state" content="Static" />
	<meta name="cache-control" content="Public" />
	<meta http-equiv="Content-Language" content="EN-US" />
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />

	<link rel="icon" type="image/png" href="<? echo get_bloginfo('stylesheet_directory'); ?>/favicon.png" />

	<meta http-equiv="X-UA-Compatible" content="IE=9" />

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<script>
		(function(i, s, o, g, r, a, m) {
			i['GoogleAnalyticsObject'] = r;
			i[r] = i[r] || function() {
				(i[r].q = i[r].q || []).push(arguments)
			}, i[r].l = 1 * new Date();
			a = s.createElement(o),
				m = s.getElementsByTagName(o)[0];
			a.async = 1;
			a.src = g;
			m.parentNode.insertBefore(a, m)
		})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

		ga('create', 'UA-30349227-1', 'auto');
		ga('send', 'pageview');
	</script>

</head>

<body baseURL="<? echo get_bloginfo('stylesheet_directory'); ?>" post-ID="<? echo $post->ID ?>" post-type="<? echo get_post_type($post->ID) ?>" post-name="<? echo $post->post_name ?>" categories="<? echo trim($post_categories, $separator) ?>">

	<? global $headerlock;
	$headerlock = ($headerlock == 1 ? ' header-locked' : ''); ?>

	<span class="phone-nav">&#x2630;</span>
	<div class="logo">
		<a href="/">
			<?php
			if ($post->ID == 11183) :
				echo wp_get_attachment_image(11196, 'full');
			else :
				echo '<img src="http://v2.bikecleveland.org/wp-content/themes/bikecle-v2/_images/logo-header.svg">';
			endif;
			?>
		</a>
	</div>
	<div class="logo logo-sm"><a href="/"><img src="http://v2.bikecleveland.org/wp-content/themes/bikecle-v2/_images/logo-footer.svg"></a></div>

	<div class="header"></div>

	<?php wp_nav_menu(array('container' => false, 'menu' => 'main')); ?>
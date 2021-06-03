<?
/* ADD POST TYPES */
function create_posttype()
{
	register_post_type(
		'home_images',
		array(
			'labels' => array(
				'name' => __('Home Images'),
				'singular_name' => __('Home Image'),
				'search_items' => __("Search Home Images"),
			),
			'supports' => array('title', 'thumbnail', 'page-attributes'),
			'public' => false,
			'show_in_menu' => true,
			'show_ui' => true,
			'has_archive' => false,
			'menu_position'      => 20,
		)
	);

	register_post_type(
		'sponsors_supporters',
		array(
			'labels' => array(
				'name' => __('Sponsors and Supporters'),
				'singular_name' => __('Sponsors and Supporters'),
				'search_items' => __("Search Sponsors and Supporters"),
			),
			'supports' => array('title', 'thumbnail', 'page-attributes'),
			'public' => false,
			'show_in_menu' => true,
			'show_ui' => true,
			'has_archive' => false,
			'menu_position'      => 20,
		)
	);
	register_taxonomy('sponsors_supporters_type', 'sponsors_supporters', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));

	register_post_type(
		'staff_and_board',
		array(
			'labels' => array(
				'name' => __('Staff and Board of Directors'),
				'singular_name' => __('Staff and Board of Directors'),
			),
			'supports' => array('title', 'thumbnail', 'editor', 'page-attributes'),
			'public' => false,
			'show_in_menu' => true,
			'show_ui' => true,
			'has_archive' => false,
			'menu_position'      => 20,
		)
	);
	register_taxonomy('staff_or_board', 'staff_and_board', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));

	register_post_type(
		'newsroom',
		array(
			'labels' => array(
				'name' => __('Newsroom'),
				'singular_name' => __('Newsroom'),
			),
			'supports' => array('title', 'thumbnail', 'editor'),
			'public' => false,
			'show_in_menu' => true,
			'show_ui' => true,
			'has_archive' => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-admin-site',
		)
	);

	register_post_type(
		'faqs',
		array(
			'labels' => array(
				'name' => __('FAQs'),
				'singular_name' => __('FAQ'),
			),
			'supports' => array('title', 'editor', 'page-attributes'),
			'public' => false,
			'show_in_menu' => true,
			'show_ui' => true,
			'has_archive' => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-hammer',
		)
	);
	register_taxonomy('faqs_type', 'faqs', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));

	register_post_type(
		'alldrivers',
		array(
			'labels' => array(
				'name' => __('All Drivers'),
				'singular_name' => __('Driver'),
				'add_new' => __('Add New Driver'),
				'add_new_item' => __('Add New Driver'),
				'edit_item' => __('Edit Driver'),
			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'thumbnail', 'page-attributes'),
			'menu_icon'          => 'dashicons-smiley',
			'menu_position' => 20,
		)
	);
	register_taxonomy('alldrivers_type', 'alldrivers', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));


	//flush_rewrite_rules();
}
add_action('init', 'create_posttype');

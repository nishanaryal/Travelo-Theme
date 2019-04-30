<?php

	if ( ! class_exists( 'Redux' ) ) {
		return;
	}

	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$opt_name = "travelo";
	$theme = wp_get_theme(); // For use with some settings. Not necessary.

	$args = array(
		'opt_name'             => $opt_name,
		'disable_tracking' => true,
		'display_name'         => $theme->get( 'Name' ),
		'display_version'      => $theme->get( 'Version' ),
		'menu_type'            => 'submenu',
		'allow_sub_menu'       => false,
		'menu_title'           => __( 'Theme Options', 'trav' ),
		'page_title'           => __( 'Travelo Theme Options', 'trav' ),
		'google_api_key'       => '',
		'google_update_weekly' => false,
		'async_typography'     => true,
		//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
		'admin_bar'            => true,
		'admin_bar_icon'       => 'dashicons-portfolio',
		'admin_bar_priority'   => 50,
		'global_variable'      => 'trav_options',
		'dev_mode'             => false,
		'update_notice'        => false,
		'customizer'           => true,
		//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
		//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
		'page_priority'        => null,
		'page_parent'          => 'themes.php',
		'page_permissions'     => 'manage_options',
		'menu_icon'            => '',
		'last_tab'             => '',
		'page_icon'            => 'icon-themes',
		'page_slug'            => 'Travelo',
		'save_defaults'        => true,
		'default_show'         => false,
		'default_mark'         => '',
		'show_import_export'   => true,
		'transient_time'       => 60 * MINUTE_IN_SECONDS,
		'output'               => true,
		'output_tag'           => true,
		// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
		'database'             => '',
		'system_info'          => false,
		//'compiler'             => true,
		'hints'                => array(
			'icon'          => 'el el-question-sign',
			'icon_position' => 'right',
			'icon_color'    => 'lightgray',
			'icon_size'     => 'normal',
			'tip_style'     => array(
				'color'   => 'red',
				'shadow'  => true,
				'rounded' => false,
				'style'   => '',
			),
			'tip_position'  => array(
				'my' => 'top left',
				'at' => 'bottom right',
			),
			'tip_effect'    => array(
				'show' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'mouseover',
				),
				'hide' => array(
					'effect'   => 'slide',
					'duration' => '500',
					'event'    => 'click mouseleave',
				),
			),
		)
	);

	$args['share_icons'][] = array(
		'url'   => 'http://twitter.com/soaptheme',
		'title' => 'Follow us on Twitter',
		'icon'  => 'el el-twitter'
	);

	$args['intro_text'] = '';
	$args['footer_text'] = '&copy; 2015 Travelo';

	Redux::setArgs( $opt_name, $args );

	$tabs = array(
		array(
			'id'      => 'redux-help-tab-1',
			'title'   => __( 'Theme Information', 'trav' ),
			'content' => __( '<p>If you have any question please check documentation <a href="http://soaptheme.net/document/travelo-wp/">Documentation</a>. And that are beyond the scope of documentation, please feel free to contact us.</p>', 'trav' )
		),
	);
	Redux::setHelpTab( $opt_name, $tabs );

	// Set the help sidebar
	$content = __( '<p></p>', 'trav' );
	Redux::setHelpSidebar( $opt_name, $content );

	Redux::setSection( $opt_name, array(
		'title' => __( 'Basic Settings', 'trav' ),
		'id'    => 'basic-settings',
		'icon'  => 'el el-home',
		'fields'     => array(
			array(
				'id'       => 'welcome_txt',
				'type'     => 'text',
				'title'    => __( 'Welcome Text', 'trav' ),
				'subtitle' => __( 'Set welcome text on login and signup page', 'trav' ),
				'default'  => 'Welcome to Travelo!',
			),
			array(
				'id'       => 'signup_desc',
				'type'     => 'text',
				'title'    => __( 'Agreement Content', 'trav' ),
				'subtitle' => __( "Set agreement content for signup. ( in signup modal )", 'trav' ),
				'default'  => "By signing up, I agree to Travelo's Terms of Service, Privacy Policy, Guest Refund Policy, and Host Guarantee Terms",
			),
			array(
				'id'       => 'copyright',
				'type'     => 'text',
				'title'    => __( 'Copyright Text', 'trav' ),
				'subtitle' => __( 'Set copyright text in footer', 'trav' ),
				'default'  => '2015 Travelo',
			),
			array(
				'id'       => 'email',
				'type'     => 'text',
				'title'    => __('E-Mail Address', 'trav'),
				'subtitle' => __( 'Set email address text in header( in header7 )', 'trav' ),
				'desc' => __('Leave blank to hide e-mail field', 'trav'),
				'default'  => '',
			),
			array(
				'id'       => 'phone_no',
				'type'     => 'text',
				'title'    => __('Phone Number', 'trav'),
				'subtitle' => __( 'Set phone number text in header( in header2 & header7 )', 'trav' ),
				'desc' => __('Leave blank to hide phone number field', 'trav'),
				'default'  => '',
			),
			array(
				'id'       => 'pace_loading',
				'type'     => 'switch',
				'title'    => __( 'Page Load Progress Bar', 'trav' ),
				'subtitle' => __( 'Enable page load progress bar while page loading', 'trav' ),
				'default'  => true,
			),
			array(
				'id'       => 'modal_login',
				'type'     => 'switch',
				'title'    => __('Modal Login/Sign Up', 'trav'),
				'subtitle' => __('Enable modal login and modal signup.', 'trav'),
				'default'  => true,
			),
			array(
				'id'       => 'ajax_pagination',
				'type'     => 'switch',
				'title'    => __('Ajax Pagination', 'trav'),
				'subtitle' => __('Enable ajax pagination.', 'trav'),
				'default'  => false,
			),
			array(
				'id'       => 'sticky_menu',
				'type'     => 'switch',
				'title'    => __( 'Sticky Menu', 'trav' ),
				'subtitle' => __( 'Enable Sticky Menu', 'trav' ),
				'default'  => true,
			),
			array(
				'id'       => 'date_format',
				'type'     => 'select',
				'title'    => __('Date Format', 'trav'),
				'subtitle' => __('Please select a date format for datepicker.', 'trav'),
				'options'  => array(
								'mm/dd/yy' => 'mm/dd/yy',
								'dd/mm/yy' => 'dd/mm/yy',
								'yy-mm-dd' => 'yy-mm-dd',
							  ),
				'default'  => 'mm/dd/yy'
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title' => __( 'Styling Options', 'trav' ),
		'id'    => 'styling-settings',
		'icon'  => 'el el-brush'
	) );


	Redux::setSection( $opt_name, array(
		'title'      => __( 'Logo & Favicon', 'trav' ),
		'id'         => 'logo-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'favicon',
				'type'     => 'media',
				'url'      => true,
				'title'    => __( 'Favicon' ),
				'compiler' => 'true',
				'desc'     => '',
				'subtitle' => __( 'Set a 16x16 ico image for your favicon', 'trav' ),
				'default'  => array( 'url' => TRAV_TEMPLATE_DIRECTORY_URI . "/images/favicon.ico" ),
			),
			array(
				'id'       => 'logo',
				'type'     => 'media',
				'url'      => true,
				'title'    => __( 'Logo Image' ),
				'compiler' => 'true',
				'desc'     => '',
				'subtitle' => __( 'Set an image file for your logo', 'trav' ),
				'default'  => array( 'url' => TRAV_TEMPLATE_DIRECTORY_URI . "/images/logo.png" ),
			),
			array(
				'id'             => 'logo_height_header',
				'type'           => 'dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'false',  // Allow users to select any type of unit
				'title'          => __( 'Header Logo Height', 'trav' ),
				'subtitle'  => __( 'Set height of logo in header', 'trav' ),
				'desc'           => __( 'Leave blank to use default value that supported by each header style', 'trav' ),
				'width'         => false,
				'default'        => array()
			),
			array(
				'id'             => 'logo_height_footer',
				'type'           => 'dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'false',  // Allow users to select any type of unit
				'title'          => __( 'Footer Logo Height', 'trav' ),
				'subtitle'  => __( 'Set height of logo in footer', 'trav' ),
				'desc'           => __( 'Leave blank to use default value that supported by each footer style', 'trav' ),
				'width'         => false,
				'default'        => array()
			),
			array(
				'id'             => 'logo_height_loading',
				'type'           => 'dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'false',  // Allow users to select any type of unit
				'title'          => __( 'Loading Page Logo Height', 'trav' ),
				'subtitle'  => __( 'Set height of logo in loading page', 'trav' ),
				'desc'           => __( 'Leave blank to use default value that supported by theme', 'trav' ),
				'width'         => false,
				'default'        => array()
			),
			array(
				'id'             => 'logo_height_404',
				'type'           => 'dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'false',  // Allow users to select any type of unit
				'title'          => __( '404 Page Logo Height', 'trav' ),
				'subtitle'  => __( 'Set height of logo in 404', 'trav' ),
				'desc'           => __( 'Leave blank to use default value that supported by theme', 'trav' ),
				'width'         => false,
				'default'        => array()
			),
			array(
				'id'             => 'logo_height_chaser',
				'type'           => 'dimensions',
				'units'          => 'px',    // You can specify a unit value. Possible: px, em, %
				'units_extended' => 'false',  // Allow users to select any type of unit
				'title'          => __( 'Chaser Menu Logo Height', 'trav' ),
				'subtitle'  => __( 'Set height of logo in chaser menu ( fixed menu bar at the top while scrolling. ). ', 'trav' ),
				'desc'           => __( 'Leave blank to use default value that supported by theme', 'trav' ),
				'width'         => false,
				'default'        => array()
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Header & Footer', 'trav' ),
		'id'         => 'hf-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'header_style',
				'type'     => 'image_select',
				'title'    => __('Header Style', 'trav'), 
				'subtitle' => __('Select header style', 'trav'),
				'options'  => array(
					'header'      => array(
						'alt'   => 'header0', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h-def.jpg'
					),
					'header1'      => array(
						'alt'   => 'header1', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h1.jpg'
					),
					'header2'      => array(
						'alt'   => 'header2', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h2.jpg'
					),
					'header3'      => array(
						'alt'   => 'header3', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h3.jpg'
					),
					'header4'      => array(
						'alt'   => 'header4', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h4.jpg'
					),
					'header5'      => array(
						'alt'   => 'header5', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h5.jpg'
					),
					'header6'      => array(
						'alt'   => 'header6', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h6.jpg'
					),
					'header7'      => array(
						'alt'   => 'header7', 
						'img'   => TRAV_IMAGE_URL . '/admin/header/h7.jpg'
					),
				),
				'default' => 'header'
			),
			array(
				'id'       => 'footer_skin',
				'type'     => 'image_select',
				'title'    => __('Footer Style', 'trav'), 
				'subtitle' => __('Select footer style', 'trav'),
				'options'  => array(
					'style-def'      => array(
						'alt'   => 'style-def', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style-def.jpg'
					),
					'style1'      => array(
						'alt'   => 'style1', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style1.jpg'
					),
					'style2'      => array(
						'alt'   => 'style2', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style2.jpg'
					),
					'style3'      => array(
						'alt'   => 'style3', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style3.jpg'
					),
					'style4'      => array(
						'alt'   => 'style4', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style4.jpg'
					),
					'style5'      => array(
						'alt'   => 'style5', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style5.jpg'
					),
					'style6'      => array(
						'alt'   => 'style6', 
						'img'   => TRAV_IMAGE_URL . '/admin/footer/style6.jpg'
					),
				),
				'default' => 'style-def'
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Site Skin & Layout', 'trav' ),
		'id'         => 'skin-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'skin',
				'type'     => 'image_select',
				'title'    => __('Site Skin', 'trav'), 
				'subtitle' => __('Select a Site Skin', 'trav'),
				'options'  => array(
					'style-light-blue'      => array(
						'alt'   => 'light blue',
						'title' => 'Light-Blue',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/light-blue.jpg'
					),
					'style-dark-blue'      => array(
						'alt'   => 'dark blue',
						'title' => 'Dark-Blue',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/dark-blue.jpg'
					),
					'style-sea-blue'      => array(
						'alt'   => 'sea blue',
						'title' => 'Sea-Blue',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/sea-blue.jpg'
					),
					'style-sky-blue'      => array(
						'alt'   => 'sky blue',
						'title' => 'Sky-Blue',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/sky-blue.jpg'
					),
					'style-dark-orange'      => array(
						'alt'   => 'dark orange',
						'title' => 'Dark-Orange',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/dark-orange.jpg'
					),
					'style-light-orange'      => array(
						'alt'   => 'light orange',
						'title' => 'Light-Orange',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/light-orange.jpg'
					),
					'style-light-yellow'      => array(
						'alt'   => 'light yellow',
						'title' => 'Light-Yellow',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/light-yellow.jpg'
					),
					'style-orange'      => array(
						'alt'   => 'orange',
						'title' => 'Orange',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/orange.jpg'
					),
					'style-purple'      => array(
						'alt'   => 'purple',
						'title' => 'Purple',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/purple.jpg'
					),
					'style-red'      => array(
						'alt'   => 'red',
						'title' => 'Red',
						'img'   => TRAV_IMAGE_URL . '/admin/skin/red.jpg'
					),
				),
				'default' => 'style-light-blue'
			),
			array(
				'id'       => 'boxed_version',
				'type'     => 'switch',
				'title'    => __( 'Boxed Layout', 'trav' ),
				'subtitle' => __( 'Enable Boxed Layout', 'trav' ),
				'default'  => false,
			),
			array(
				'id'       => 'body_background',
				'type'     => 'background',
				'required' => array( 'boxed_version', '=', true ),
				'output'   => array( 'body' ),
				'title'    => __( 'Body Background', 'trav' ),
				'subtitle' => __( 'Body background with image, color, etc.', 'trav' ),
				'default'   => '#FFFFFF',
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Social Sharing Links', 'trav' ),
		'id'         => 'social-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'title' => __('Facebook', 'trav'),
				'desc' => __( 'Insert your custom link to show the Facebook icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'facebook',
				'type' => 'text'),
			array(
				'title' => __('Twitter', 'trav'),
				'desc' => __( 'Insert your custom link to show the Twitter icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'twitter',
				'type' => 'text'),
			array(
				'title' => __('Google+', 'trav'),
				'desc' => __( 'Insert your custom link to show the Google+ icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'googleplus',
				'type' => 'text'),
			array(
				'title' => __('LinkedIn', 'trav'),
				'desc' => __( 'Insert your custom link to show the LinkedIn icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'linkedin',
				'type' => 'text'),
			array(
				'title' => __('YouTube', 'trav'),
				'desc' => __( 'Insert your custom link to show the YouTube icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'youtube',
				'type' => 'text'),
			array(
				'title' => __('Vimeo', 'trav'),
				'desc' => __( 'Insert your custom link to show the Vimeo icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'vimeo',
				'type' => 'text'),
			array(
				'title' => __('Pinterest', 'trav'),
				'desc' => __( 'Insert your custom link to show the Pinterest icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'pinterest',
				'type' => 'text'),
			array(
				'title' => __('Skype', 'trav'),
				'desc' => __( 'Insert your custom link to show the Skype icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'skype',
				'type' => 'text'),
			array(
				'title' => __('Instagram', 'trav'),
				'desc' => __( 'Insert your custom link to show the Instagram icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'instagram',
				'type' => 'text'),
			array(
				'title' => __('Dribbble', 'trav'),
				'desc' => __( 'Insert your custom link to show the Dribbble icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'dribble',
				'type' => 'text'),
			array(
				'title' => __('Flickr', 'trav'),
				'desc' => __( 'Insert your custom link to show the Flickr icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'flickr',
				'type' => 'text'),
			array(
				'title' => __('Tumblr', 'trav'),
				'desc' => __( 'Insert your custom link to show the Tumblr icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'tumblr',
				'type' => 'text'),
			array(
				'title' => __('Behance', 'trav'),
				'desc' => __( 'Insert your custom link to show the Behance icon. Leave blank to hide icon.', 'trav' ),
				'id' => 'behance',
				'type' => 'text')
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Custom JS & CSS', 'trav' ),
		'id'         => 'custom-code',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'custom_css',
				'type'     => 'ace_editor',
				'title'    => __( 'Custom CSS Code', 'trav' ),
				'subtitle' => __( 'Paste your CSS code here.', 'trav' ),
				'mode'     => 'css',
				'theme'    => 'chrome',
				'default'  => ""
			),
			array(
				'id'       => 'custom_js',
				'type'     => 'ace_editor',
				'title'    => __( 'Custom Javascript Code', 'trav' ),
				'subtitle' => __( 'Paste your Javascript code here.', 'trav' ),
				'mode'     => 'javascript',
				'theme'    => 'chrome',
				'default'  => ""
			),
		)
	) );

	$desc = __('All price fields in admin panel will be considered in this currency', 'trav');
	require_once TRAV_INC_DIR . '/functions/currency.php';
	Redux::setSection( $opt_name, array(
		'title'      => __( 'Currency Settings', 'trav' ),
		'id'         => 'currency-settings',
		'icon'  => 'el el-usd',
		'fields'     => array(
			array(
				'id'       => 'def_currency',
				'type'     => 'select',
				'title'    => __( 'Default Currency', 'trav' ),
				'subtitle' => __( 'Select default currency', 'trav' ),
				'desc'     => apply_filters( 'trav_options_def_currency_desc', $desc ),
				//Must provide key => value pairs for select options
				'options'  => trav_get_all_available_currencies(),
				'default'  => 'usd'
			),
			array(
				'id'       => 'site_currencies',
				'type'     => 'checkbox',
				'title'    => __('Available Currencies', 'trav'),
				'subtitle' => __('You can select currencies that this site support. You can manage currency list <a href="admin.php?page=currencies">here</a>', 'trav'),
				'desc'     => '',
				'options'  => trav_get_all_available_currencies(),
				'default'  => trav_get_default_available_currencies()
			),
			array(
				'id'       => 'cs_pos',
				'type'     => 'button_set',
				'title'    => __( 'Currency Symbol Position', 'trav' ),
				'subtitle' => __( "Select a Curency Symbol Position for Frontend", 'trav' ),
				'desc'     => '',
				'options'  => array(
					'before' => __( 'Before Price', 'trav' ),
					'after' => __( 'After Price', 'trav' )
				),
				'default'  => 'before'
			),
			array(
				'id'       => 'decimal_prec',
				'type'     => 'select',
				'title'    => __( 'Decimal Precision', 'trav' ),
				'subtitle' => __( 'Please choose decimal precision', 'trav' ),
				'desc'     => '',
				'options'  => array(
								'0' => '0',
								'1' => '1',
								'2' => '2',
								'3' => '3',
								),
				'default'  => '2'
			),
			array(
				'id'       => 'currency_format',
				'type'     => 'select',
				'title'    => __( 'Currency Display Format', 'trav' ),
				'subtitle' => __( 'Please choose currency display format', 'trav' ),
				'desc'     => '',
				'options'  => array(
								'nodelimit-point' => '####.##',
								'nodelimit-comma' => '####,##',
								'cdelimit-point' => '#,###.##',
								'pdelimit-comma' => '#.###,##',
								'cbdelimit-point' => "#, ###.##",
								'bdelimit-point' => '# ###.##',
								'bdelimit-comma' => '# ###,##',
								'qdelimit-point' => "#'###.##",
							   ),
				'default'  => 'nodelimit-point'
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Main Page Settings', 'trav' ),
		'id'         => 'main-page-settings',
		'fields'     => array(
			array(
				'id'       => 'dashboard_page',
				'type'     => 'select',
				'title'    => __('Dashboard Page', 'trav'),
				'subtitle' => __('User Dashboard Page.', 'trav'),
				'desc'     => '',
				'options'  => $options_pages,
				'default'  => ''
			),
			array(
				'id'       => 'login_page',
				'type'     => 'select',
				'title'    => __('Login Page', 'trav'),
				'subtitle' => __('You can leave this field blank if you don\'t need Custom Login Page', 'trav'),
				'desc'     => __('If you set wrong page you should be unable to login. In that case you can login with /wp-login.php?no_redirect=1', 'trav'),
				'options'  => $options_pages,
				'default'  => ''
			),
			array(
				'id'       => 'redirect_page',
				'type'     => 'select',
				'title'    => __('Page to Redirect to on login', 'trav'),
				'subtitle' => __('Select a Page to Redirect to on login.', 'trav'),
				'options'  => $options_pages,
				'default'  => ''
			),
		)
	) );

	Redux::setSection( $opt_name, array(
		'title' => __( 'Accommodation', 'trav' ),
		'id'    => 'accommodation-settings',
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Accommodation Main Settings', 'trav' ),
		'id'         => 'accommodation-main-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'disable_acc',
				'type'     => 'button_set',
				'title'    => __('Enable/Disable accommodation feature.', 'trav'),
				'default'  => 0,
				'options'  => array(
					'0' => __( 'Enable', 'trav' ),
					'1' => __( 'Disable', 'trav' )
				),
			),
			array(
				'id'       => 'acc_booking_page',
				'type'     => 'select',
				'required' => array( 'disable_acc', '=', '0' ),
				'title'    => __('Accommodation Booking Page', 'trav'),
				'subtitle' => __('This sets the base page of your accommodation booking.', 'trav'),
				'options'  => $options_pages,
			),
			array(
				'id'       => 'acc_booking_confirmation_page',
				'type'     => 'select',
				'required' => array( 'disable_acc', '=', '0' ),
				'title'    => __('Accommodation Booking Confirmation Page', 'trav'),
				'subtitle' => __('This sets the accommodation booking confirmation page.', 'trav'),
				'options'  => $options_pages,
			),
			array(
				'id'       => 'terms_page',
				'type'     => 'select',
				'required' => array( 'disable_acc', '=', '0' ),
				'title'    => __('Terms & Conditions Page', 'trav'),
				'subtitle' => __('Booking Terms and Conditions Page.', 'trav'),
				'options'  => $options_pages,
			),
			array(
				'id'       => 'acc_posts',
				'type'     => 'text',
				'required' => array( 'disable_acc', '=', '0' ),
				'title'    => __( 'Accommodations per page', 'trav' ),
				'subtitle' => __( 'Select a number of accommodations to show on Search Accommodation Result Page', 'trav' ),
				'default'  => '12',
			),
			array(
				'id' => "acc_price_filter_max",
				'type' => 'text',
				'required' => array( 'disable_acc', '=', '0' ),
				'title' => "Price Filter Max Value",
				'subtitle' => __( "Set a max price value for price search filter", 'trav' ),
				'default' => "200",
			),
			array(
				'id' => "acc_price_filter_step",
				'type' => 'text',
				'required' => array( 'disable_acc', '=', '0' ),
				'title' => "Price Filter Step",
				'subtitle' => __( "Set a price step value for price search filter", 'trav' ),
				'default' => "50",
			),
			array(
				'id' => 'vld_captcha',
				'type' => 'switch',
				'required' => array( 'disable_acc', '=', '0' ),
				'title' => __('Captcha validation on booking', 'trav'),
				'subtitle' => __('Use captcha validation while booking.', 'trav'),
				'default' => true,
			),
		),
	) );

	// add-on compatibility
	$acc_add_on_settings = apply_filters( 'trav_options_acc_addon_settings', array() );
	if ( ! empty( $acc_add_on_settings ) ) {
		Redux::setSection( $opt_name, array(
			'title'      => __( 'Accommodation Add-On Settings', 'trav' ),
			'id'         => 'accommodation-add-settings',
			'subsection' => true,
			'fields'     => array( $acc_add_on_settings )
		) );
	}

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Accommodation Email Settings', 'trav' ),
		'id'         => 'accommodation-email-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'acc_confirm_email_start',
				'type'     => 'section',
				'title'    => __( 'Customer Email Setting', 'trav' ),
				// 'subtitle' => __( '', 'trav' ),
				'indent'   => true,
			),
			array(
				'title' => __('Enable Icalendar', 'trav'),
				'subtitle' => __('Send icalendar with booking confirmation email.', 'trav'),
				'id' => 'acc_confirm_email_ical',
				'default' => true,
				'type' => 'switch'),
			array(
				'title' => __('Booking Confirmation Email Subject', 'trav'),
				'subtitle' => __( 'Accommodation booking confirmation email subject.', 'trav' ),
				'id' => 'acc_confirm_email_subject',
				'default' => 'Your booking at [accommodation_name]',
				'type' => 'text'),
			array(
				'title' => __('Booking Confirmation Email Description', 'trav'),
				'subtitle' => __( 'Accommodation booking confirmation email description.', 'trav' ),
				'id' => 'acc_confirm_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_confirm_email_description.htm' ),
				'type' => 'editor'),
			array(
				'title' => __('Update Booking Email Subject', 'trav'),
				'subtitle' => __( 'Accommodation update booking email subject.', 'trav' ),
				'id' => 'acc_update_email_subject',
				'default' => 'Your booking at [accommodation_name] is now updated.',
				'type' => 'text'),
			array(
				'title' => __('Update Booking Email Description', 'trav'),
				'subtitle' => __( 'Accommodation update booking email description.', 'trav' ),
				'id' => 'acc_update_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_update_email_description.htm' ),
				'type' => 'editor'),
			array(
				'title' => __('Cancel Booking Email Subject', 'trav'),
				'subtitle' => __( 'Accommodation cancel booking email subject.', 'trav' ),
				'id' => 'acc_cancel_email_subject',
				'default' => 'Your booking at [accommodation_name] is now canceled.',
				'type' => 'text'),
			array(
				'title' => __('Cancel Booking Email Description', 'trav'),
				'subtitle' => __( 'Accommodation cancel booking email description.', 'trav' ),
				'id' => 'acc_cancel_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_cancel_email_description.htm' ),
				'type' => 'editor'),
			array(
				'id'     => 'acc_confirm_email_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'acc_admin_email_start',
				'type'     => 'section',
				'title'    => __( 'Admin Notification Setting', 'trav' ),
				// 'subtitle' => __( '', 'trav' ),
				'indent'   => true,
			),
			array(
				'title' => __('Administrator Notification', 'trav'),
				'subtitle' => __('enable individual booked email notification to site administrator.', 'trav'),
				'id' => 'acc_booked_notify_admin',
				'default' => 'true',
				'type' => 'switch'),
			array(
				'title' => __('Administrator Booking Notification Email Subject', 'trav'),
				'subtitle' => __( 'Administrator Notification Email Subject for Accommodation Booking.', 'trav' ),
				'id' => 'acc_admin_email_subject',
				'default' => 'Received a booking at [accommodation_name]',
				'required' => array( 'acc_booked_notify_admin', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Administrator Booking Notification Email Description', 'trav'),
				'subtitle' => __( 'Administrator Notification Email Description for Accommodation Booking.', 'trav' ),
				'id' => 'acc_admin_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_admin_email_description.htm' ),
				'required' => array( 'acc_booked_notify_admin', '=', '1' ),
				'type' => 'editor'),
			array(
				'title' => __('Administrator Booking Update Notification Email Subject', 'trav'),
				'subtitle' => __( 'Administrator notification email subject for accommodation booking update.', 'trav' ),
				'id' => 'acc_update_admin_email_subject',
				'default' => 'A booking at [accommodation_name] is updated.',
				'required' => array( 'acc_booked_notify_admin', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Administrator Booking Update Notification Email Description', 'trav'),
				'subtitle' => __( 'Administrator notification email description for accommodation booking update.', 'trav' ),
				'id' => 'acc_update_admin_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_update_admin_email_description.htm' ),
				'required' => array( 'acc_booked_notify_admin', '=', '1' ),
				'type' => 'editor'),
			array(
				'title' => __('Administrator Booking Cancel Notification Email Subject', 'trav'),
				'subtitle' => __( 'Administrator notification email subject for accommodation booking cancel.', 'trav' ),
				'id' => 'acc_cancel_admin_email_subject',
				'default' => 'A booking at [accommodation_name] is canceled.',
				'required' => array( 'acc_booked_notify_admin', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Administrator Booking Cancel Notification Email Description', 'trav'),
				'subtitle' => __( 'Administrator notification email description for accommodation booking cancel.', 'trav' ),
				'id' => 'acc_cancel_admin_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_cancel_admin_email_description.htm' ),
				'required' => array( 'acc_booked_notify_admin', '=', '1' ),
				'type' => 'editor'),
			array(
				'id'     => 'acc_admin_email_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'acc_bowner_email_start',
				'type'     => 'section',
				'title'    => __( 'Accommodation Onwer Notification Setting', 'trav' ),
				// 'subtitle' => __( '', 'trav' ),
				'indent'   => true,
			),
			array(
				'title' => __('Accommodation Owner Notification', 'trav'),
				'subtitle' => __('enable individual booked email notification to accommodation owner.', 'trav'),
				'id' => 'acc_booked_notify_bowner',
				'default' => 'true',
				'type' => 'switch'),
			array(
				'title' => __('Accommodation Owner Notification Email Subject', 'trav'),
				'subtitle' => __( 'Accommodation Owner Notification Email Subject for Accommodation Booking.', 'trav' ),
				'id' => 'acc_bowner_email_subject',
				'default' => 'Received a booking at [accommodation_name]',
				'required' => array( 'acc_booked_notify_bowner', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Accommodation Owner Notification Email Description', 'trav'),
				'subtitle' => __( 'Accommodation Owner Notification Email Description for Accommodation Booking.', 'trav' ),
				'id' => 'acc_bowner_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_bowner_email_description.htm' ),
				'required' => array( 'acc_booked_notify_bowner', '=', '1' ),
				'type' => 'editor'),
			array(
				'title' => __('Accommodation Owner Booking Update Notification Email Subject', 'trav'),
				'subtitle' => __( 'Accommodation Owner notification email subject for accommodation booking update.', 'trav' ),
				'id' => 'acc_update_bowner_email_subject',
				'default' => 'A booking at [accommodation_name] is updated.',
				'required' => array( 'acc_booked_notify_bowner', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Accommodation Owner Booking Update Notification Email Description', 'trav'),
				'subtitle' => __( 'Accommodation Owner notification email description for accommodation booking update.', 'trav' ),
				'id' => 'acc_update_bowner_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_update_bowner_email_description.htm' ),
				'required' => array( 'acc_booked_notify_bowner', '=', '1' ),
				'type' => 'editor'),
			array(
				'title' => __('Accommodation Owner Booking Cancel Notification Email Subject', 'trav'),
				'subtitle' => __( 'Accommodation Owner notification email subject for accommodation booking cancel.', 'trav' ),
				'id' => 'acc_cancel_bowner_email_subject',
				'default' => 'A booking at [accommodation_name] is canceled.',
				'required' => array( 'acc_booked_notify_bowner', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Accommodation Owner Booking Cancel Notification Email Description', 'trav'),
				'subtitle' => __( 'Accommodation Owner notification email description for accommodation booking cancel.', 'trav' ),
				'id' => 'acc_cancel_bowner_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/acc_cancel_bowner_email_description.htm' ),
				'required' => array( 'acc_booked_notify_bowner', '=', '1' ),
				'type' => 'editor'),
			array(
				'id'     => 'acc_bowner_email_end',
				'type'   => 'section',
				'indent' => false,
			),
		),
	) );


	Redux::setSection( $opt_name, array(
		'title' => __( 'Tour', 'trav' ),
		'id'    => 'tour-settings',
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Tour Main Settings', 'trav' ),
		'id'         => 'tour-main-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'disable_tour',
				'type'     => 'button_set',
				'title'    => __('Enable/Disable tour feature.', 'trav'),
				'default'  => 0,
				'options'  => array(
					'0' => __( 'Enable', 'trav' ),
					'1' => __( 'Disable', 'trav' )
				),
			),
			array(
				'id'       => 'tour_booking_page',
				'type'     => 'select',
				'required' => array( 'disable_tour', '=', '0' ),
				'title'    => __('Tour Booking Page', 'trav'),
				'subtitle' => __('This sets the base page of your tour booking.', 'trav'),
				'options'  => $options_pages,
			),
			array(
				'id'       => 'tour_booking_confirmation_page',
				'type'     => 'select',
				'required' => array( 'disable_tour', '=', '0' ),
				'title'    => __('Tour Booking Confirmation Page', 'trav'),
				'subtitle' => __('This sets the tour booking confirmation page.', 'trav'),
				'options'  => $options_pages,
			),
			array(
				'id'       => 'tour_terms_page',
				'type'     => 'select',
				'required' => array( 'disable_tour', '=', '0' ),
				'title'    => __('Terms & Conditions Page', 'trav'),
				'subtitle' => __('Booking Terms and Conditions Page.', 'trav'),
				'options'  => $options_pages,
			),
			array(
				'id'       => 'tour_posts',
				'type'     => 'text',
				'required' => array( 'disable_tour', '=', '0' ),
				'title'    => __( 'Tours per page', 'trav' ),
				'subtitle' => __( 'Select a number of tours to show on Search Tour Result Page', 'trav' ),
				'default'  => '12',
			),
			array(
				'id' => "tour_price_filter_max",
				'type' => 'text',
				'required' => array( 'disable_tour', '=', '0' ),
				'title' => "Price Filter Max Value",
				'subtitle' => __( "Set a max price value for price search filter", 'trav' ),
				'default' => "200",
			),
			array(
				'id' => "tour_price_filter_step",
				'type' => 'text',
				'required' => array( 'disable_tour', '=', '0' ),
				'title' => "Price Filter Step",
				'subtitle' => __( "Set a price step value for price search filter", 'trav' ),
				'default' => "50",
			),
			array(
				'id' => 'tour_vld_captcha',
				'type' => 'switch',
				'required' => array( 'disable_tour', '=', '0' ),
				'title' => __('Captcha validation on booking', 'trav'),
				'subtitle' => __('Use captcha validation while booking.', 'trav'),
				'default' => true,
			),
		),
	) );

	Redux::setSection( $opt_name, array(
		'title'      => __( 'Tour Email Settings', 'trav' ),
		'id'         => 'tour-email-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'       => 'tour_confirm_email_start',
				'type'     => 'section',
				'title'    => __( 'Customer Email Setting', 'trav' ),
				// 'subtitle' => __( '', 'trav' ),
				'indent'   => true,
			),
			array(
				'title' => __('Booking Confirmation Email Subject', 'trav'),
				'subtitle' => __( 'Tour booking confirmation email subject.', 'trav' ),
				'id' => 'tour_confirm_email_subject',
				'default' => 'Your booking at [tour_name]',
				'type' => 'text'),
			array(
				'title' => __('Booking Confirmation Email Description', 'trav'),
				'subtitle' => __( 'Tour booking confirmation email description.', 'trav' ),
				'id' => 'tour_confirm_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/tour_confirm_email_description.htm' ),
				'type' => 'editor'),
			array(
				'title' => __('Cancel Booking Email Subject', 'trav'),
				'subtitle' => __( 'Tour cancel booking email subject.', 'trav' ),
				'id' => 'tour_cancel_email_subject',
				'default' => 'Your booking at [tour_name] is now canceled.',
				'type' => 'text'),
			array(
				'title' => __('Cancel Booking Email Description', 'trav'),
				'subtitle' => __( 'Tour cancel booking email description.', 'trav' ),
				'id' => 'tour_cancel_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/tour_cancel_email_description.htm' ),
				'type' => 'editor'),
			array(
				'id'     => 'tour_confirm_email_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'tour_admin_email_start',
				'type'     => 'section',
				'title'    => __( 'Admin Notification Setting', 'trav' ),
				// 'subtitle' => __( '', 'trav' ),
				'indent'   => true,
			),
			array(
				'title' => __('Administrator Notification', 'trav'),
				'subtitle' => __('enable individual booked email notification to site administrator.', 'trav'),
				'id' => 'tour_booked_notify_admin',
				'default' => 'true',
				'type' => 'switch'),
			array(
				'title' => __('Administrator Booking Notification Email Subject', 'trav'),
				'subtitle' => __( 'Administrator Notification Email Subject for Tour Booking.', 'trav' ),
				'id' => 'tour_admin_email_subject',
				'default' => 'Received a booking at [tour_name]',
				'required' => array( 'tour_booked_notify_admin', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Administrator Booking Notification Email Description', 'trav'),
				'subtitle' => __( 'Administrator Notification Email Description for Tour Booking.', 'trav' ),
				'id' => 'tour_admin_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/tour_admin_email_description.htm' ),
				'required' => array( 'tour_booked_notify_admin', '=', '1' ),
				'type' => 'editor'),
			array(
				'title' => __('Administrator Booking Cancel Notification Email Subject', 'trav'),
				'subtitle' => __( 'Administrator notification email subject for tour booking cancel.', 'trav' ),
				'id' => 'tour_cancel_admin_email_subject',
				'default' => 'A booking at [tour_name] is canceled.',
				'required' => array( 'tour_booked_notify_admin', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Administrator Booking Cancel Notification Email Description', 'trav'),
				'subtitle' => __( 'Administrator notification email description for tour booking cancel.', 'trav' ),
				'id' => 'tour_cancel_admin_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/tour_cancel_admin_email_description.htm' ),
				'required' => array( 'tour_booked_notify_admin', '=', '1' ),
				'type' => 'editor'),
			array(
				'id'     => 'tour_admin_email_end',
				'type'   => 'section',
				'indent' => false,
			),
			array(
				'id'       => 'tour_bowner_email_start',
				'type'     => 'section',
				'title'    => __( 'Tour Onwer Notification Setting', 'trav' ),
				// 'subtitle' => __( '', 'trav' ),
				'indent'   => true,
			),
			array(
				'title' => __('Tour Owner Notification', 'trav'),
				'subtitle' => __('enable individual booked email notification to tour owner.', 'trav'),
				'id' => 'tour_booked_notify_bowner',
				'default' => 'true',
				'type' => 'switch'),
			array(
				'title' => __('Tour Owner Notification Email Subject', 'trav'),
				'subtitle' => __( 'Tour Owner Notification Email Subject for Tour Booking.', 'trav' ),
				'id' => 'tour_bowner_email_subject',
				'default' => 'Received a booking at [tour_name]',
				'required' => array( 'tour_booked_notify_bowner', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Tour Owner Notification Email Description', 'trav'),
				'subtitle' => __( 'Tour Owner Notification Email Description for Tour Booking.', 'trav' ),
				'id' => 'tour_bowner_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/tour_bowner_email_description.htm' ),
				'required' => array( 'tour_booked_notify_bowner', '=', '1' ),
				'type' => 'editor'),
			array(
				'title' => __('Tour Owner Booking Cancel Notification Email Subject', 'trav'),
				'subtitle' => __( 'Tour Owner notification email subject for tour booking cancel.', 'trav' ),
				'id' => 'tour_cancel_bowner_email_subject',
				'default' => 'A booking at [tour_name] is canceled.',
				'required' => array( 'tour_booked_notify_bowner', '=', '1' ),
				'type' => 'text'),
			array(
				'title' => __('Tour Owner Booking Cancel Notification Email Description', 'trav'),
				'subtitle' => __( 'Tour Owner notification email description for tour booking cancel.', 'trav' ),
				'id' => 'tour_cancel_bowner_email_description',
				'default' => file_get_contents( dirname( __FILE__ ) . '/templates/tour_cancel_bowner_email_description.htm' ),
				'required' => array( 'tour_booked_notify_bowner', '=', '1' ),
				'type' => 'editor'),
			array(
				'id'     => 'tour_bowner_email_end',
				'type'   => 'section',
				'indent' => false,
			),
		),
	) );

	// add-on compatibility
	$tour_add_on_settings = apply_filters( 'trav_options_tour_addon_settings', array() );
	if ( ! empty( $tour_add_on_settings ) ) {
		Redux::setSection( $opt_name, array(
			'title'      => __( 'Tour Add-On Settings', 'trav' ),
			'id'         => 'tour-add-settings',
			'subsection' => true,
			'fields'     => array( $tour_add_on_settings )
		) );
	}

	Redux::setSection( $opt_name, array(
		'title' => __( 'Payment', 'trav' ),
		'id'    => 'payment-settings',
	) );
	Redux::setSection( $opt_name, array(
		'title' => __( 'Paypal', 'trav' ),
		'id'    => 'paypal-settings',
		'subsection' => true,
		'fields'     => array(
			array(
				'title' => __('PayPal Integration', 'trav'),
				'subtitle' => __('Enable payment through PayPal in booking step.', 'trav'),
				'id' => 'acc_pay_paypal',
				'default' => true,
				'type' => 'switch'),

			array(
				'title' => __('Sandbox Mode', 'trav'),
				'subtitle' => __('Enable PayPal sandbox for testing.', 'trav'),
				'id' => 'acc_pay_paypal_sandbox',
				'default' => false,
				'required' => array( 'acc_pay_paypal', '=', '1' ),
				'type' => 'switch'),

			array(
				'title' => __('PayPal API Username', 'trav'),
				'subtitle' => __('Your PayPal Account API Username.', 'trav'),
				'id' => 'acc_pay_paypal_api_username',
				'default' => '',
				'required' => array( 'acc_pay_paypal', '=', '1' ),
				'type' => 'text'),

			array(
				'title' => __('PayPal API Password', 'trav'),
				'subtitle' => __('Your PayPal Account API Password.', 'trav'),
				'id' => 'acc_pay_paypal_api_password',
				'default' => '',
				'required' => array( 'acc_pay_paypal', '=', '1' ),
				'type' => 'text'),

			array(
				'title' => __('PayPal API Signature', 'trav'),
				'subtitle' => __('Your PayPal Account API Signature.', 'trav'),
				'id' => 'acc_pay_paypal_api_signature',
				'default' => '',
				'required' => array( 'acc_pay_paypal', '=', '1' ),
				'type' => 'text'),
		)
	) );

	// add-on compatibility
	$payment_add_on_settings = apply_filters( 'trav_options_payment_addon_settings', array() );
	if ( ! empty( $payment_add_on_settings ) ) {
		Redux::setSection( $opt_name, array(
			'title'      => __( 'Payment Add-On Settings', 'trav' ),
			'id'         => 'payment-add-settings',
			'subsection' => true,
			'fields'     => $payment_add_on_settings
		) );
	}

	if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
		$section = array(
			'icon'   => 'el el-list-alt',
			'title'  => __( 'Documentation', 'trav' ),
			'fields' => array(
				array(
					'id'       => '17',
					'type'     => 'raw',
					'markdown' => true,
					'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
				),
			),
		);
		Redux::setSection( $opt_name, $section );
	}
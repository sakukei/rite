<?php 
/***********************************************************
* setup theme_customizer
***********************************************************/
function wcct_customize_register( $wp_customize ) {
	/* Logo Image
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[logo]', array(
		'default'			=> '',
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'control_logo',
		array(
			'label'			=> __( 'Logo image', 'welcart_basic_square' ),
			'section'		=> 'title_tagline',
			'settings'		=> 'basic_type_options[logo]',
			'priority'		=> 1,
			'description'	=> __('If the logo image has not been registered, see the site title.', 'welcart_basic_square'),
		)
	) );

	/* Site Description
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[display_description]', array(
		'default'			=> true,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_display_description', array(
		'label'				=> __( 'Display the Catchphrase', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[display_description]',
		'type'				=> 'checkbox',
		'priority'			=> 10,
	) );

	/* SNS button
	------------------------------------------------------*/
	/* facebook */
	$wp_customize->add_setting( 'basic_type_options[facebook_id]', array(
		'default'			=> '',
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'control_facebook_id', array(
		'label'				=> __( 'Display facebook', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[facebook_id]',
		'type'				=> 'text',
		'priority'			=> 131,
		'description'		=> __( 'Enter the your page name.', 'welcart_basic_square' ),
	) );
	$wp_customize->add_setting( 'basic_type_options[facebook_button]', array(
		'default'			=> false,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_facebook_button', array(
		'label'				=> __( 'Show facebook', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[facebook_button]',
		'type'				=> 'checkbox',
		'priority'			=> 132,
	) );
	/* Twitter */
	$wp_customize->add_setting( 'basic_type_options[twitter_id]', array(
		'default'			=> '',
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'control_twitter_id', array(
		'label'				=> __( 'Display twitter', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[twitter_id]',
		'type'				=> 'text',
		'priority'			=> 133,
		'description'		=> __( 'Enter the user name.', 'welcart_basic_square' ),
	) );
	$wp_customize->add_setting( 'basic_type_options[twitter_button]', array(
		'default'			=> false,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_twitter_button', array(
		'label'				=> __( 'Show twitter', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[twitter_button]',
		'type'				=> 'checkbox',
		'priority'			=> 134,
	) );
	/* Instagram */
	$wp_customize->add_setting( 'basic_type_options[instagram_id]', array(
		'default'			=> '',
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'control_instagram_id', array(
		'label'				=> __( 'Display instagram', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[instagram_id]',
		'type'				=> 'text',
		'priority'			=> 135,
		'description'		=> __( 'Enter the user name.', 'welcart_basic_square' ),
	) );
	$wp_customize->add_setting( 'basic_type_options[instagram_button]', array(
		'default'			=> false,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_instagram_button', array(
		'label'				=> __( 'Show instagram', 'welcart_basic_square' ),
		'section'			=> 'title_tagline',
		'settings'			=> 'basic_type_options[instagram_button]',
		'type'				=> 'checkbox',
		'priority'			=> 136,
	) );


	/* Display order
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[display_sort]', array(
		'default'			=> 0,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'control_display_sort', array(
		'label'				=> __( 'Display order of the top page', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[display_sort]',
		'type'				=> 'select',
		'choices'			=> array(
								0	=> __( 'Order by post id.', 'welcart_basic_square' ),
								1	=> __( 'Order by date.', 'welcart_basic_square' ),
								2	=> __( 'Random order.', 'welcart_basic_square' ),
							),
		'active_callback'	=> 'callback_is_itemlist',
		'priority'			=> 150,
	) );

	/* Display items
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[display_soldout]', array(
		'default'			=> true,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_display_soldout', array(
		'label'				=> __( 'Display the Soldout', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[display_soldout]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_is_itemlist',
		'priority'			=> 150,
	) );
	$wp_customize->add_setting( 'basic_type_options[display_inquiry]', array(
		'default'			=> true,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_display_inquiry', array(
		'label'				=> __( 'Display the inquiry text', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[display_inquiry]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_display_inquiry',
		'priority'			=> 151,
	) );
	$wp_customize->add_setting( 'basic_type_options[display_inquiry_text]', array(
		'default'			=> __( 'Contacting this item', 'welcart_basic_square' ),
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'control_display_inquiry_text', array(
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[display_inquiry_text]',
		'type'				=> 'text',
		'active_callback'	=> 'callback_display_inquiry',
		'priority'			=> 152,
		'description'		=> __( 'Enter the message you want to display.', 'welcart_basic_square' ),
	) );
	$wp_customize->add_setting( 'basic_type_options[display_produt_tag]', array(
		'default'			=> true,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_display_produt_tag', array(
		'label'				=> __( 'Display the produt tag', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[display_produt_tag]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_is_itemlist',
		'priority'			=> 154,
	) );

	/* Home Information
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[display_info]', array(
		'default'			=> true,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'control_display_info', array(
		'label'				=> __( 'Display information' , 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[display_info]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'is_front_page',
		'priority'			=>  160,
	) );
	$wp_customize->add_setting( 'basic_type_options[info_cat]', array(
		'default'			=> wcct_get_info_default(),
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
	) );	
	$wp_customize->add_control( 'info_cat', array(
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[info_cat]',
		'type'   			=> 'select',
		'choices' 			=> wcct_get_info_categories(),
		'active_callback'	=> 'callback_display_information',
		'priority'			=> 161,
		'description'		=> __( 'Please select a category to be displayed.', 'welcart_basic_square' ),
	) );
	$wp_customize->add_setting( 'basic_type_options[info_num]', array(
		'default'    => 10,
		'type'       => 'option',
		'capability' => 'edit_theme_options',
	));
	$wp_customize->add_control( 'info_num', array(
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[info_num]',
		'type'				=> 'number',
		'input_attrs'		=> array( 'min' => '1' ),
		'active_callback'	=> 'callback_display_information',
		'priority'			=> 162,
		'description'		=> __( 'Please select a display number.', 'welcart_basic_square' ),
	));

	/* Name change of the cart button
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[cart_button]', array(
		'default'			=> __( 'Add to Shopping Cart', 'usces' ),
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'sanitize_text_field',
	) );
	$wp_customize->add_control( 'control_cart_button', array(
		'label'				=> __( 'The cart button', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[cart_button]',
		'type'				=> 'text',
		'active_callback'	=> 'callback_is_itemsingle',
		'priority'			=> 170,
	) );
	
	/* Display the inquiry button
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[inquiry_link]', array(
		'default'			=> 0,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
	) );
	$wp_customize->add_control( 'control_inquiry_link', array(
		'label'				=> __( 'The inquiry button', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[inquiry_link]',
		'type'				=> 'dropdown-pages',
		'active_callback'	=> 'callback_is_itemsingle',
		'priority'			=> 180,
		'description'		=> __('Display the inquiry button when the product is sold out.<br />Please select Page.', 'welcart_basic_square'),
	) );
	$wp_customize->add_setting( 'basic_type_options[inquiry_link_button]', array(
		'default'			=> false,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_inquiry_link_button', array(
		'label'				=> __( 'Display the inquiry button', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[inquiry_link_button]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_is_itemsingle',
		'priority'			=> 190,
	) );
	
	/* Displays the reviews
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[review]', array(
		'default'			=> false,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_review', array(
		'label'				=> __( 'Show product reviews', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[review]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_is_itemsingle',
		'priority'			=> 200,
	) );
	
	/* The continue shopping button
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[continue_shopping_button]', array(
		'default'			=> false,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_continue_shopping_button', array(
		'label'				=> __( 'Change the destination link', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[continue_shopping_button]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_is_cartpage',
		'priority'			=> 140,
	) );
	$wp_customize->add_setting( 'basic_type_options[continue_shopping_url]', array(
		'default'			=> '',
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'esc_url',
	) );
	$wp_customize->add_control( 'control_continue_shopping_url', array(
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[continue_shopping_url]',
		'type'				=> 'url',
		'active_callback'	=> 'callback_continue_shopping',
		'priority'			=> 141,
		'description'		=> __( 'Destination URL', 'welcart_basic_square' ),
	) );

	/* Display Category Image
	------------------------------------------------------*/
	$wp_customize->add_setting( 'basic_type_options[cat_image]', array(
		'default'			=> true,
		'type'				=> 'option',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback' => 'wcct_sanitize_checkbox',
	) );
	$wp_customize->add_control( 'control_cat_image', array(
		'label'				=> __( 'Displayed over the image', 'welcart_basic_square' ),
		'section'			=> 'welcart_basic_design',
		'settings'			=> 'basic_type_options[cat_image]',
		'type'				=> 'checkbox',
		'active_callback'	=> 'callback_is_category',
		'priority'			=> 141,
	) );

	/* Custom Color
	------------------------------------------------------*/
	/* Site Color */
	$wp_customize->add_setting( 'site_color', array(
		'default'			=> '#333',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'site_color',
		array(
			'label'			=> __( 'Site color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'site_color',
		)
	) );
	/* header */
	$wp_customize->add_setting( 'header_color', array(
		'default'			=> '#333',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'header_color',
		array(
			'label'			=> __( 'Header Color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'header_color',
			'description'	=> __( 'It will work when viewed in tablet and smartphone', 'welcart_basic_square' ),
		)
	) );
	/* Main Text */
	$wp_customize->add_setting( 'main_text', array(
		'default'			=> '#333',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'main_text',
		array(
			'label'			=> __( 'Main text color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'main_text',
		)
	) );
	/* Sub Text */
	$wp_customize->add_setting( 'sub_text', array(
		'default'			=> '#999',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'sub_text',
		array(
			'label'			=> __( 'Sub text color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'sub_text',
		)
	) );
	/* Page Title */
	$wp_customize->add_setting( 'page_title', array(
		'default'			=> '#333',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'page_title',
		array(
			'label'			=> __( 'Page Title', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'page_title',
			'description'	=> __( 'Page title color other than the fixed with the articles page', 'welcart_basic_square' ),
		)
	) );
	/* Price-color */
	$wp_customize->add_setting( 'price_color', array(
		'default'			=> '#d3222a',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'price_color',
		array(
			'label'			=> __( 'Price color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'price_color',
		)
	) );
	/* Link Color */
	$wp_customize->add_setting( 'text_link_color', array(
		'default'			=> '#808080',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'text_link_color',
		array(
			'label'			=> __( 'Text link color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'text_link_color',
		)
	) );
	/* Footer Link Color */
	$wp_customize->add_setting( 'footer_color', array(
		'default'			=> '#808080',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'footer_color',
		array(
			'label'			=> __( 'Footer Color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'footer_color',
		)
	) );
	/* Cart Button Color */
	$wp_customize->add_setting( 'cart_color', array(
		'default'			=> '#d3222a',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'cart_color',
		array(
			'label'			=> __( 'Cart button color', 'welcart_basic_square' ),
			'section' 		=> 'colors',
			'settings'		=> 'cart_color',
		)
	) );
	/* Contact Button Color */
	$wp_customize->add_setting( 'contact_btn_color', array(
		'default'			=> '#666',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'contact_btn_color',
		array(
			'label'			=> __( 'The inquiry button', 'welcart_basic_square' ),
			'section' 		=> 'colors',
			'settings'		=> 'contact_btn_color',
		)
	) );
	/* Main Button Color */
	$wp_customize->add_setting( 'main_btn', array(
		'default'			=> '#d3222a',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'main_btn',
		array(
			'label'			=> __( 'Main button color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'main_btn',
		)
	) );
	/* Sub Button Color */
	$wp_customize->add_setting( 'sub_btn', array(
		'default'			=> '#efefef',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'sub_btn',
		array(
			'label'			=> __( 'Sub button color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'sub_btn',
		)
	) );
	/* OTher Button Color */
	$wp_customize->add_setting( 'other_btn', array(
		'default'			=> '#d3222a',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'other_btn',
		array(
			'label'			=> __( 'Other button color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'other_btn',
		)
	) );
	/* opt-tag */
	$wp_customize->add_setting( 'opt_new', array(
		'default'			=> '#d3222a',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'opt_new',
		array(
			'label'			=> __( 'New Products tag color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'opt_new',
		)
	) );
	
	$wp_customize->add_setting( 'opt_reco', array(
		'default'			=> '#89c997',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'opt_reco',
		array(
			'label'			=> __( 'Recommended products tag color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'opt_reco',
		)
	) );
	
	$wp_customize->add_setting( 'opt_stock', array(
		'default'			=> '#89a6c9',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'opt_stock',
		array(
			'label'			=> __( 'stock tag color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'opt_stock',
		)
	) );
	
	$wp_customize->add_setting( 'opt_sale', array(
		'default'			=> '#8266dc',
		'sanitize_callback'	=> 'maybe_hash_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'opt_sale',
		array(
			'label'			=> __( 'Sale tag color', 'welcart_basic_square' ),
			'section'		=> 'colors',
			'settings'		=> 'opt_sale',
		)
	) );

	
	/* Sanitize
	------------------------------------------------------*/
	function wcct_sanitize_checkbox( $input ){
		if( $input == true ){
			return true;
		} else {
			return false;
		}
	}

	/* Callback
	------------------------------------------------------*/
	function callback_is_itemlist() {
		return is_front_page() || is_home() || is_archive() || is_search();
	}
	function callback_is_itemsingle() {
		return is_single() && usces_is_item();
	}
	function callback_is_cartpage() {
		return welcart_basic_is_cart_page();
	}
	function callback_is_category() {
		return is_category();
	}
	function callback_display_inquiry( $control ) {
		if( !is_front_page() && !is_home() && !is_archive() && !is_search() )
			return false;
		
		if ( $control->manager->get_setting( 'basic_type_options[display_soldout]' )->value() )
			return true;
	}
	function callback_continue_shopping( $control ) {
		if( !welcart_basic_is_cart_page() )
			return false;
		
		if ( $control->manager->get_setting( 'basic_type_options[continue_shopping_button]' )->value() )
			return true;
	}
	function callback_display_information( $control ) {
		if( !is_front_page() && !is_home() )
			return false;
		
		if ( $control->manager->get_setting( 'basic_type_options[display_info]' )->value() )
			return true;
	}
}
add_action( 'customize_register', 'wcct_customize_register' );


/* Customizer CSS
------------------------------------------------------*/
function wcct_customize_css() {
	if( 'customize.php' == basename( $_SERVER['PHP_SELF'] ) ) {
		?>
<style type="text/css">
#customize-control-control_facebook_id:before {
	content: "<?php _e( 'SNS mark in footer', 'welcart_basic_square' ); ?>";
}
#customize-control-control_display_soldout:before {
	content: "<?php _e( 'Display in the commodity block', 'welcart_basic_square' ); ?>";
}
#customize-control-control_review:before {
	content: "<?php _e( 'Display product reviews', 'welcart_basic_square' ); ?>";
}
#customize-control-control_continue_shopping_button:before {
	content: "<?php _e( 'Link for a continue shopping button', 'welcart_basic_square' ); ?>";
}
#customize-control-control_display_info:before {
	content: "<?php _e( 'Information article', 'welcart_basic_square' ); ?>";
}
#customize-control-control_cat_image:before {
	content: "<?php _e( 'Category name position', 'welcart_basic_square' ); ?>";
}
</style>
		<?php
	}
}
add_action( 'admin_print_styles' , 'wcct_customize_css' );

/***********************************************************
* Display theme option
***********************************************************/
function wcct_get_options( $key = '' ) {
	if( empty( $key ) )
		return;
	
	$options = get_option( 'basic_type_options' );
	
	if( !is_admin() ) {	
		if( !isset( $options['logo'] ) ) $options['logo'] = '';
		if( !isset( $options['facebook_id'] ) ) $options['facebook_id'] = '';
		if( !isset( $options['facebook_button'] ) ) $options['facebook_button'] = false;
		if( !isset( $options['twitter_id'] ) ) $options['twitter_id'] = '';
		if( !isset( $options['twitter_button'] ) ) $options['twitter_button'] = false;
		if( !isset( $options['instagram_id'] ) ) $options['instagram_id'] = '';
		if( !isset( $options['instagram_button'] ) ) $options['instagram_button'] = false;
		if( !isset( $options['display_sort'] ) ) $options['display_sort'] = '';
		if( !isset( $options['display_description'] ) ) $options['display_description'] = true;
		if( !isset( $options['display_soldout'] ) ) $options['display_soldout'] = true;
		if( !isset( $options['display_inquiry'] ) ) $options['display_inquiry'] = true;
		if( !isset( $options['display_inquiry_text'] ) ) $options['display_inquiry_text'] = __( 'Contacting this item' , 'welcart_basic_square' );
		if( !isset( $options['display_produt_tag'] ) ) $options['display_produt_tag'] = true;
		if( !isset( $options['cart_button'] ) ) $options['cart_button'] = __( 'Add to Shopping Cart', 'usces' );
		if( !isset( $options['inquiry_link'] ) ) $options['inquiry_link'] = 0;
		if( !isset( $options['inquiry_link_button'] ) ) $options['inquiry_link_button'] = false;
		if( !isset( $options['review'] ) ) $options['review'] = false;
		if( !isset( $options['continue_shopping_button'] ) ) $options['continue_shopping_button'] = false;
		if( !isset( $options['continue_shopping_url'] ) ) $options['continue_shopping_url'] = '';
		if( !isset( $options['display_info'] ) ) $options['display_info'] = true;
		if( !isset( $options['info_cat'] ) ) $options['info_cat'] = wcct_get_info_default();
		if( !isset( $options['info_num'] ) ) $options['info_num'] = 10;
		if( !isset( $options['cat_image'] ) ) $options['cat_image'] = true;
	}
	
	return $options[$key];
}
function wcct_options( $key = '' ) {
	echo wcct_get_options( $key );
}

/***********************************************************
* Information Select & Default
***********************************************************/
function wcct_get_info_categories() {
	$target_arg		= array(
						'exclude_tree'	=>	usces_get_cat_id( 'item' ),
					);
	$target_terms	= get_terms( 'category', $target_arg );
	$info_terms		= array();
	
	foreach( $target_terms as $term ){
		$info_terms[ $term->slug ] = $term->name;
	}
	
	return $info_terms;
}
function wcct_get_info_default() {
	$info_terms = wcct_get_info_categories();
    reset( $info_terms );
    return key( $info_terms );
}

/***********************************************************
* RGB Color
***********************************************************/
function wcct_rgb($hex) {
	$hex = str_replace("#", "", $hex);
	
	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}
	$rgb = array($r, $g, $b);

	return $rgb;
}

/***********************************************************
* Custom Color
***********************************************************/

function wcct_customizer_footer_styles() {
	$site_color			= get_theme_mod( 'site_color', '#333' );
	$header_color		= get_theme_mod( 'header_color', '#333' );
	$main_text			= get_theme_mod( 'main_text', '#333' );
	$sub_text			= get_theme_mod( 'sub_text', '#999' );
	$page_title			= get_theme_mod( 'page_title', '#333' );
	$price_color		= get_theme_mod( 'price_color', '#d3222a' );
	$text_link_color	= get_theme_mod( 'text_link_color', '#808080' );
	$text_link_rgb		= implode(", ", wcct_rgb( $text_link_color ) );
	$footer_color		= get_theme_mod( 'footer_color', '#808080' );
	$footer_rgb			= implode(", ", wcct_rgb( $footer_color ));
	$text_link_h		= get_theme_mod( 'text_link_h', '#22b2d3' );
	$cart_color			= get_theme_mod( 'cart_color', '#d3222a' );
	$cart_btn_rgb 		= implode(", ", wcct_rgb( $cart_color ) );
	$contact_btn_color	= get_theme_mod( 'contact_btn_color', '#666' );
	$contact_btn_rgb 	= implode(", ", wcct_rgb( $contact_btn_color ) );
	$main_btn_color		= get_theme_mod( 'main_btn', '#d3222a' );
	$main_btn_rgb		= implode(", ", wcct_rgb( $main_btn_color ) );
	$sub_btn_color		= get_theme_mod( 'sub_btn', '#efefef' );
	$sub_btn_rgb		= implode(", ", wcct_rgb( $sub_btn_color ) );
	$other_btn			= get_theme_mod( 'other_btn', '#d3222a' );
	$opt_new			= get_theme_mod( 'opt_new', '#d3222a' );
	$opt_reco			= get_theme_mod( 'opt_reco', '#89c997' );
	$opt_stock			= get_theme_mod( 'opt_stock', '#89a6c9' );
	$opt_sale			= get_theme_mod( 'opt_sale', '#8266dc' );
	$custom_bg			= get_background_color();
	?>
<style type="text/css">
	body {
		color: <?php echo $main_text; ?>;
		border: 5px solid <?php echo $site_color; ?>;
	}
	a {
		color: <?php echo $text_link_color; ?>;
	}
	a:hover {
		color: rgba(<?php echo $text_link_rgb; ?>, .6);
	}
	.send a:hover,
	.member_submenu a:hover,
	.member_submenu a:hover,
	#wc_member .gotoedit a:hover,
	#wc_newcompletion a:hover,
	#wc_lostcompletion #memberpages p a:hover {
		color: <?php echo $main_text; ?>;
	}
	/* -- main_btn -- */
	.send input.to_customerinfo_button,
	.send input.to_memberlogin_button,
	.send input.to_deliveryinfo_button,
	.send input.to_confirm_button,
	.send input#purchase_button,
	#wc_customer .send input.to_reganddeliveryinfo_button,
	#wc_login .loginbox #member_login,
	#wc_member .loginbox #member_login,
	#wc_login .loginbox .new-entry #nav a,
	#wc_member .loginbox .new-entry #nav a,
	.member-page .send input,
	#wc_lostmemberpassword #member_login,
	#wc_changepassword #member_login,
	#add_destination,
	#edit_destination,
	#new_destination,
	#determine,
	input[type=button].allocation_edit_button,
	.entry-content input[type="submit"],
	.item-description input[type="submit"],
	.inqbox .send input {
		color: #fff;
		background-color: rgba(<?php echo $main_btn_rgb; ?>, 1 );
	}
	.send input.to_customerinfo_button:hover,
	.send input.to_memberlogin_button:hover,
	.send input.to_deliveryinfo_button:hover,
	.send input.to_confirm_button:hover,
	.send input#purchase_button:hover,
	#wc_customer .send input.to_reganddeliveryinfo_button:hover,
	#wc_login .loginbox #member_login:hover,
	#wc_member .loginbox #member_login:hover,
	#wc_login .loginbox .new-entry #nav a:hover,
	#wc_member .loginbox .new-entry #nav a:hover,
	.member-page .send input:hover,
	#wc_lostmemberpassword #member_login:hover,
	#wc_changepassword #member_login:hover,
	#add_destination:hover,
	#edit_destination:hover,
	#new_destination:hover,
	#determine:hover,
	input[type=button].allocation_edit_button:hover,
	.entry-content input[type="submit"]:hover,
	.item-description input[type="submit"]:hover,
	.inqbox .send input:hover {
		color: #fff;
		background-color: rgba(<?php echo $main_btn_rgb; ?>, .6 );
	}
	/* - sub_btn - */
	input[type="button"],
	input[type="submit"],
	input[type="reset"],
	.member-box #nav a,
	#wc_lostmemberpassword #nav a,
	#wc_newcompletion #memberpages p a,
	#wc_lostcompletion #memberpages p a,
	#wc_changepasscompletion #memberpages p a,
	#wc_newcompletion .send a,
	#wc_lostcompletion .send input,
	#wc_lostcompletion .send a,
	#wc_changepasscompletion .send a,
	.member_submenu a,
	.gotoedit a,
	.member-page #memberinfo .send input.top,
	.member-page #memberinfo .send input.deletemember,
	#wc_ordercompletion .send a,
	#del_destination,
	.ui-dialog .ui-dialog-buttonpane button,
	#searchbox input.usces_search_button {
		color: <?php echo $main_text; ?>;
		background-color: rgba(<?php echo $sub_btn_rgb; ?>, 1 );
	}
	input[type="button"]:hover,
	input[type="submit"]:hover,
	input[type="reset"]:hover,
	.member-box #nav a:hover,
	#wc_lostmemberpassword #nav a:hover,
	#wc_newcompletion #memberpages p a:hover,
	#wc_lostcompletion #memberpages p a:hover,
	#wc_changepasscompletion #memberpages p a:hover,
	#wc_newcompletion .send a:hover,
	#wc_lostcompletion .send input:hover,
	#wc_lostcompletion .send a:hover,
	#wc_changepasscompletion .send a:hover,
	.member_submenu a:hover,
	.gotoedit a:hover,
	.member-page #memberinfo .send input.top:hover,
	.member-page #memberinfo .send input.deletemember:hover,
	#wc_ordercompletion .send a:hover,
	#del_destination:hover,
	.ui-dialog .ui-dialog-buttonpane button:hover,
	#searchbox input.usces_search_button:hover {
		color: <?php echo $main_text; ?>;
		background-color: rgba(<?php echo $sub_btn_rgb; ?>, .6 );
	}
	/* -- other_btn -- */
	#wc_cart #cart .upbutton input,
	#point_table td input.use_point_button,
	#paypal_dialog #paypal_use_point,
	#wc_reviews .reviews_btn a,
	#wdgctToCart a,
	#memberinfo table.retail .redownload_link a,
	.open_allocation_bt,
	#cart #coupon_table td .use_coupon_button {
		color: <?php echo $other_btn; ?>;
		border: 1px solid <?php echo $other_btn; ?>;
	}
	#wc_cart #cart .upbutton input:hover,
	#point_table td input.use_point_button:hover,
	#paypal_dialog #paypal_use_point:hover,
	#wc_reviews .reviews_btn a:hover,
	#wdgctToCart a:hover,
	#memberinfo table.retail .redownload_link a:hover,
	.open_allocation_bt:hover,
	#cart #coupon_table td .use_coupon_button:hover {
		color: #fff;
		background-color:<?php echo $other_btn; ?>;
	}
	/* -- site-color -- */
	#wgct_alert.update_box,
	#wgct_alert.completion_box {
		color: <?php echo $site_color; ?>;
	}
	/* -- main-text -- */
	#wgct_point span,
	.item-info #wc_regular .wcr_tlt {
		color: <?php echo $main_text; ?>;
	}
	/* -- sub_text -- */
	.item-info .field_cprice,
	#itempage .itemcode,
	.post-info-wrap .post-date,
	.post-info-wrap .post-cat,
	.entry-meta span,
	.entry-meta .date:before,
	.entry-meta .cat:before,
	.entry-meta .tag:before,
	.entry-meta .author:before {
		color: <?php echo $sub_text; ?>;
	}
	/* -- search-icon -- */
	.search-box #searchsubmit {
		color: <?php echo $site_color; ?>;
	}
	.widget_search #searchsubmit {
		color: <?php echo $main_text; ?>;
	}
	/* -- price_color -- */
	.item-info .field_price,
	.item-info .itemGpExp .price,
	.widgetcart_rows th.total_price {
		color: <?php echo $price_color; ?>;
	}
	/* -- page-title -- */
	.item_page_title,
	.cart_page_title,
	.member_page_title,
	.site-description {
		color: <?php echo $page_title; ?>;
	}
	#content .page-title,
	#content .entry-title {
		color: <?php echo $site_color; ?>;
	}
	/* -- cart_btn -- */
	.item-info .skubutton,
	#wdgctToCheckout a {
		color: #fff;
		background-color: rgba(<?php echo $cart_btn_rgb; ?>, 1 );
	}
	.item-info .skubutton:hover,
	#wdgctToCheckout a:hover {
		color: #fff;
		background-color: rgba(<?php echo $cart_btn_rgb; ?>, .6 );
	}

	/* =header
	-------------------------------------------------------------- */				
	header {
		border-bottom: 2px solid <?php echo $site_color; ?>;
	}
	/* -- .site-title -- */
	h1.site-title a,
	div.site-title a,
	.incart-btn i {
		color: <?php echo $header_color; ?>;
	}
	/* -- .menu-bar -- */
	.menu-trigger span,
	.menu-trigger.active span {
		background-color: <?php echo $header_color; ?>;	
	}
	/* -- .incart-btn / .search-form -- */
	.incart-btn .total-quant {
		color: #fff;
		background-color: <?php echo $cart_color; ?>;
	}
	/* -- .opt-tag -- */
	.opt-tag .new {
		background-color: <?php echo $opt_new; ?>;
	}
	.opt-tag .recommend {
		background-color: <?php echo $opt_reco; ?>;
	}
	.opt-tag .stock {
		background-color: <?php echo $opt_stock; ?>;
	}
	.opt-tag .sale {
		background-color: <?php echo $opt_sale; ?>;
	}
	/* -- site-navigation + .membership -- */
	#site-navigation li a {
		color: <?php echo $site_color; ?>;
	}
	.snav .membership li:first-child {
		color: <?php echo $main_text; ?>;
	}

	/* =secondary
	-------------------------------------------------------------- */				
	#secondary h3,
	#content .sidebar .widget h3 {
		color: <?php echo $main_text; ?>;
	}
	/* -- widget -- */
	.widget_welcart_search #searchsubmit,
	.widget_welcart_login input#member_loginw,
	.widget_welcart_login input#member_login {
		background-color: rgba(<?php echo $main_btn_rgb; ?>, 1 );
	}
	.widget_welcart_search #searchsubmit:hover,
	.widget_welcart_login input#member_loginw:hover,
	.widget_welcart_login input#member_login:hover {
		background-color: rgba(<?php echo $main_btn_rgb; ?>, .6 );
	}
	.welcart_blog_calendar th,
	.widget_welcart_calendar th,
	.widget_calendar th {
		background-color: <?php echo $site_color; ?>;
	}
	#secondary {
		border-top: 1px solid <?php echo $footer_color; ?>;
	}
	
	/* =footer
	-------------------------------------------------------------- */	
	footer {
		border-top: 1px solid <?php echo $footer_color; ?>;
	}
	footer nav a,
	.sns li a {
		color: <?php echo $footer_color; ?>;
	}
	footer nav a:hover,
	.sns li a:hover,
	.copyright {
		color: rgba( <?php echo $footer_rgb; ?>, .6 );
	}
	#toTop i {
		background-color: <?php echo $site_color; ?>;
	}

	/* =main
	-------------------------------------------------------------- */
	/* -- pagenation -- */
	.pagination_wrapper li .current {
		background-color: <?php echo $site_color; ?>;
	}
	.pagination_wrapper li a {
		color: <?php echo $site_color; ?>;
		background-color: #fff;
		border: 1px solid <?php echo $site_color; ?>;
	}
	.pagination_wrapper li a:hover {
		color: #fff;
		background-color: <?php echo $site_color; ?>;	
	}
	
	/* =single.php + page.php
	-------------------------------------------------------------- */
	.entry-content h3 {
		border-color: <?php echo $site_color; ?>;		
	}
	
	/* =item-single.php
	-------------------------------------------------------------- */
	.item-info .skuname:after {
		background-color: <?php echo $main_text; ?>;
	}
	.tab-list li.select {
		border-bottom: 2px solid <?php echo $main_text; ?>;
	}
	.tab-list li.select,
	.assistance_item h3 {
		color: <?php echo $main_text; ?>;
	}
	.item-description h3 {
		border-left: 5px solid <?php echo $site_color; ?>;
	}
	/* -- #wc_review -- */
	.contact-item a {
		background-color: rgba(<?php echo $contact_btn_rgb; ?>, 1 );
	}
	.contact-item a:hover {
		background-color: rgba(<?php echo $contact_btn_rgb; ?>, .6 );
	}
	/* -- delseller -- */
	.field_frequency {
		background-color: rgba(<?php echo $cart_btn_rgb; ?>, 1 );
	}

	/* =cart-page + member-page
	-------------------------------------------------------------- */				
	#confirm_table tr.ttl td {
		background-color: <?php echo $site_color; ?>;
	}
	/* -- .cart-navi -- */
	div.cart_navi li.current span {
		background-color: <?php echo $site_color; ?>;
	}
	div.cart_navi li.current {
		color: <?php echo $site_color; ?>;
	}
	/* -- dlseller -- */
	#memberinfo #history_head td.retail a {
		color: <?php echo $text_link_color; ?>;
	}
	#memberinfo #history_head td.retail a:hover {
		color: rgba( <?php $text_link_rgb; ?>, .6 );
	}
	/* -- autodelivery -- */
	#wc_autodelivery_history .send input {
		color: <?php echo $main_text; ?>;
		background-color: rgba(<?php echo $sub_btn_rgb; ?>, 1 );
	}
	#wc_autodelivery_history .send input:hover {
		background-color: rgba(<?php echo $sub_btn_rgb; ?>, .6 );	
	}
	#wc_autodelivery_history h3 {
		color: <?php echo $main_text; ?>;
	}
	#wc_autodelivery_history h3:after {
		background-color: <?php echo $main_text; ?>;
	}
	/* -- multiple-shipping -- */
	#del_destination,
	#cancel_destination,
	.ui-dialog .ui-dialog-buttonpane button {
		color: <?php echo $main_text; ?>;
	}
	
	/**
	 * Mobile Large 620px
	 */
	@media screen and (min-width: 46.25em) {
		body {
			border: 10px solid <?php echo $site_color; ?>;	
		}
	}

	/**
	 * Desktop Small 1000px
	 */
	@media screen and (min-width: 62.5em) {
		/* =header
		-------------------------------------------------------------- */				
		header {
			border: 1px solid #ddd;
		}
		/* -- .site-title -- */
		h1.site-title a,
		div.site-title a,
		.incart-btn i,
		.menu-trigger span,
		.menu-trigger.active span {
			color: <?php echo $site_color; ?>;
		}
		/* -- .incart-btn -- */
		.incart-btn i:before,
		.snav .search-box i,
		.snav .membership i {
			color: <?php echo $site_color; ?>;
		}
		/* -- .search-box + .membership -- */
		.search-box div.s-box {
			border: 1px solid <?php echo $site_color; ?>;
		}
		/* -- #site-navigation -- */
		#site-navigation li a:hover,
		#site-navigation ul ul li:hover > a,
		#site-navigation li.current_page_item a,
		#site-navigation li.current-menu-item a,
		#site-navigation li.current-menu-parent a {
			color: #fff;
			background-color: <?php echo $site_color; ?>;
		}
		#site-navigation ul ul li a {
			color: <?php echo $site_color; ?>;
		}
		#site-navigation li.current_page_item a,
		#site-navigation li.current-menu-item a,
		#site-navigation li.current-menu-parent a,
		#site-navigation li.current_page_item li a:hover,
		#site-navigation li.current-menu-parent li a:hover,
		#site-navigation li.current-menu-item li a:hover  {
			color: #fff;
		}
		#site-navigation li li:first-child a {
			color: <?php echo $site_color; ?>;
		}
		#site-navigation li.current_page_item li a,
		#site-navigation li.current-menu-parent li a {
			color: <?php echo $site_color; ?>;
		}

		#site-navigation li.current-menu-ancestor a,
		#site-navigation li.current-menu-ancestor li.current-menu-ancestor a,
		#site-navigation li.current-menu-ancestor li.current-menu-item a,
		#site-navigation li.current-menu-ancestor li.current-menu-ancestor a:hover,
		#site-navigation li.current-menu-ancestor li.current-menu-item li a:hover,
		#site-navigation li.current-menu-ancestor li a:hover {
			color: #fff;
			background-color: <?php echo $site_color; ?>;
		}

		#site-navigation li.current-menu-ancestor li a,
		#site-navigation li.current-menu-ancestor li.current-menu-item li a {
			color: <?php echo $site_color; ?>;
			background-color: #fff;
		}

		#site-navigation li.current-menu-item li a {
			color: <?php echo $site_color; ?>;
			background: none;
		}


	}
</style>
	<?php
}
add_action( 'wp_footer', 'wcct_customizer_footer_styles' );


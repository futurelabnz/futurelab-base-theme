<?php
/**
 * futurelab base Theme Customizer
 *
 * @package futurelab_base
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function futurelab_base_customize_register( $wp_customize ) {

	/*
	 * Additional controls for site header (appear in title and tagline)
	 */
	$wp_customize->add_setting( 'additional_navigation_button', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_control( 'additional_navigation_button', array(
			'type'        => 'text',
			'section'     => 'title_tagline',
			'priority'    => 10,
			'label'       => __( 'Additional navigation button', 'futurelab_base' ),
			'description' => __( 'The text to appear if you want an additional navigation button on the top right of the menu.', 'futurelab-base' ),
		)
	);

	$wp_customize->add_setting( 'additional_navigation_button_url', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_control( 'additional_navigation_button_url', array(
			'type'        => 'text',
			'section'     => 'title_tagline',
			'priority'    => 10,
			'label'       => __( 'Additional navigation button target url', 'futurelab_base' ),
			'description' => __( 'The target url for the additional navigation button on the top right of the menu.', 'futurelab-base' ),
		)
	);

	$wp_customize->add_setting( 'additional_navigation_button_target', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_control( 'additional_navigation_button_target', array(
			'type'     => 'select',
			'section'  => 'title_tagline',
			'priority' => 10,
			'label'    => __( 'Button should open', 'futurelab-base' ),
			'choices'  => array(
				'_blank'  => 'New page',
				'_self' => 'Same tab'
			)
		)
	);

	$wp_customize->add_setting( 'futurelab_footer_tagline', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_control( 'futurelab_footer_tagline', array(
			'type'     => 'text',
			'section'  => 'title_tagline',
			'priority' => 10,
			'label'    => __( 'Footer tagline', 'futurelab-base' ),
		)
	);

	/*
	 * Choose font
	 */

	$wp_customize->add_setting( 'futurelab_font', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_control( 'futurelab_font', array(
			'type'        => 'textbox',
			'section'     => 'custom_css',
			'priority'    => 10,
			'label'       => __( 'Font to use with this FutureLab site.', 'futurelab_base' ),
			'description' => __( 'The data for the Google font used on this site.', 'futurelab-base' ),
		)
	);

	/*
	 * Additional controls for contact details
	 */
	$wp_customize->add_section( 'contact_details',
		array(
			'title'       => __( 'Contact details', 'futurelab-base' ),
			'description' => __( 'Add addresses, names and phone numbers here.' ),
			'priority'    => 160,
		)
	);

	$wp_customize->add_setting( 'physical_address', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_setting( 'business_name', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_setting( 'business_number', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_setting( 'google_map_url', array(
			'type' => 'theme_mod'
		)
	);

	$wp_customize->add_section( 'contact_details',
		array(
			'title'       => __( 'Contact details', 'futurelab-base' ),
			'description' => __( 'Add addresses, names and phone umbers here.' ),
			'priority'    => 160,
		)
	);

	$wp_customize->add_control( 'physical_address', array(
			'type'        => 'textarea',
			'section'     => 'contact_details',
			'priority'    => 10,
			'label'       => __( 'Physical address', 'futurelab_base' ),
			'description' => __( 'The physical address of the business', 'futurelab-base' ),
		)
	);

	$wp_customize->add_control( 'business_name', array(
			'type'        => 'text',
			'section'     => 'contact_details',
			'priority'    => 10,
			'label'       => __( 'Business name', 'futurelab-base' ),
			'description' => __( 'The name of the business', 'futurelab-base' ),
		)
	);

	$wp_customize->add_control( 'business_number', array(
			'type'        => 'text',
			'section'     => 'contact_details',
			'priority'    => 10,
			'label'       => __( 'Business number', 'futurelab-base' ),
			'description' => __( 'The telephone number of the business', 'futurelab-base' ),
		)
	);

	$wp_customize->add_control( 'google_map_url', array(
			'type'        => 'text',
			'section'     => 'contact_details',
			'priority'    => 10,
			'label'       => __( 'On Google maps', 'futurelab-base' ),
			'description' => __( 'The URL of the Google Maps image showing the business and details', 'futurelab-base' ),
		)
	);

	/*
	 * Social media information
	 */
	$wp_customize->add_section( 'social_media',
		array(
			'title'       => __( 'Social media details', 'futurelab-base' ),
			'description' => __( 'Add details of social media accounts here.' ),
			'priority'    => 160,
		)
	);

	$wp_customize->add_setting( 'fl_social_media[fa-linkedin]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media[fa-facebook]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media[fa-twitter]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media[fa-instagram]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media[fa-pinterest]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_control( 'fl_social_media[fa-linkedin]', array(
			'type'     => 'text',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'LinkedIn', 'futurelab-base' )
		)
	);

	$wp_customize->add_control( 'fl_social_media[fa-facebook]', array(
			'type'     => 'text',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Facebook', 'futurelab-base' )
		)
	);

	$wp_customize->add_control( 'fl_social_media[fa-twitter]', array(
			'type'     => 'text',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Twitter', 'futurelab-base' )
		)
	);

	$wp_customize->add_control( 'fl_social_media[fa-instagram]', array(
			'type'     => 'text',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Instagram', 'futurelab-base' )
		)
	);

	$wp_customize->add_control( 'fl_social_media[fa-pinterest]', array(
			'type'     => 'text',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Pinterest', 'futurelab-base' )
		)
	);

	/* Order of importance */
	$wp_customize->add_setting( 'fl_social_media_order[fa-linkedin]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media_order[fa-facebook]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media_order[fa-twitter]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media_order[fa-instagram]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_setting( 'fl_social_media_order[fa-pinterest]', array(
			'type' => 'option'
		)
	);

	$wp_customize->add_control( 'fl_social_media_order[fa-linkedin]', array(
			'type'     => 'select',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'LinkedIn', 'futurelab-base' ),
			'choices'  => array(
				''  => '',
				'0' => 'First',
				'1' => 'Second',
				'2' => 'Third',
				'3' => 'Fourth',
				'4' => 'Fifth'
			)
		)
	);

	$wp_customize->add_control( 'fl_social_media_order[fa-facebook]', array(
			'type'     => 'select',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Facebook', 'futurelab-base' ),
			'choices'  => array(
				''  => '',
				'0' => 'First',
				'1' => 'Second',
				'2' => 'Third',
				'3' => 'Fourth',
				'4' => 'Fifth'
			)
		)
	);

	$wp_customize->add_control( 'fl_social_media_order[fa-twitter]', array(
			'type'     => 'select',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Twitter', 'futurelab-base' ),
			'choices'  => array(
				''  => '',
				'0' => 'First',
				'1' => 'Second',
				'2' => 'Third',
				'3' => 'Fourth',
				'4' => 'Fifth'
			)
		)
	);

	$wp_customize->add_control( 'fl_social_media_order[fa-instagram]', array(
			'type'     => 'select',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Instagram', 'futurelab-base' ),
			'choices'  => array(
				''  => '',
				'0' => 'First',
				'1' => 'Second',
				'2' => 'Third',
				'3' => 'Fourth',
				'4' => 'Fifth'
			)
		)
	);

	$wp_customize->add_control( 'fl_social_media_order[fa-pinterest]', array(
			'type'     => 'select',
			'section'  => 'social_media',
			'priority' => 10,
			'label'    => __( 'Pinterest', 'futurelab-base' ),
			'choices'  => array(
				''  => '',
				'0' => 'First',
				'1' => 'Second',
				'2' => 'Third',
				'3' => 'Fourth',
				'4' => 'Fifth'
			)
		)
	);
}

add_action( 'customize_register', 'futurelab_base_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function futurelab_base_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function futurelab_base_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function futurelab_base_customize_preview_js() {
	wp_enqueue_script( 'futurelab-base-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'futurelab_base_customize_preview_js' );

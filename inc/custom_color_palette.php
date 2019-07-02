<?php

namespace FutureLab;


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class custom_color_palette {

	private $color_palettes = array(
		'gray_palette'           => array(
			'--palettedark'  => '#5780A9',
			'--palettemid'   => '#93B9E1',
			'--palettelight' => '#DDE9F6'
		),
		'blue_palette'           => array(
			'--palettedark'  => '#007BFF;',
			'--palettemid'   => '#54A6FF',
			'--palettelight' => '#D2E9FF'
		),
		'green_palette'          => array(
			'--palettedark'  => '#52B462',
			'--palettemid'   => '#70D775',
			'--palettelight' => '#E7F8E8'
		),
		'teal_palette'           => array(
			'--palettedark'  => '#00B380',
			'--palettemid'   => '#00D498',
			'--palettelight' => '#D8F3EB'
		),
		'purple_palette'         => array(
			'--palettedark'  => '#7B2CFF',
			'--palettemid'   => '#A570FF',
			'--palettelight' => '#F3EBFF'
		),
		'red_palette'            => array(
			'--palettedark'  => '#D14F5F',
			'--palettemid'   => '#FF8796',
			'--palettelight' => '#F9EBEC'
		),
		'rights_institute_green' => array(
			'--palettedark'  => '#449D95',
			'--palettemid'   => '#3B827C',
			'--palettelight' => '#ACD5D2'
		)
	);

	private $background_color_palettes = array(
		'black_palette' => array(
			'--palettebgcdark'  => '#191919',
			'--palettebgcmid'   => '#222222',
			'--palettebgclight' => '#333333',
		),
		'white_palette' => array(
			'--palettebgcdark'  => '#ffffff',
			'--palettebgcmid'   => '#ffffff',
			'--palettebgclight' => '#ffffff',
		),
	);

	private $customizer_options = array(
		'gray_palette'           => 'Gray',
		'blue_palette'           => 'Blue',
		'green_palette'          => 'Green ',
		'teal_palette'           => 'Teal',
		'purple_palette'         => 'Purple',
		'red_palette'            => 'Red',
		'black_palette'          => 'Black',
		'rights_institute_green' => 'Rights Institute Green'
	);

	private $background_customizer_options = array(
		'black_palette' => 'Black',
		'white_palette' => 'White',
	);

	protected static $instance = null;

	public static function init() {

		if ( null === self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {

		add_action( 'customize_register', array( $this, 'add_custom_palette' ), 10, 1 );
		add_action( 'wp_head', array( $this, 'output_color_palette' ) );
		add_action( 'admin_head', array( $this, 'output_color_palette' ) );
	}

	public function add_custom_palette( $wp_customize ) {

		$wp_customize->add_section( 'fl_theme',
			array(
				'title'       => __( 'Theme style options', 'futurelab-base' ),
				'description' => __( 'Select FutureLab theme options' ),
				'priority'    => 160,
			)
		);

		$wp_customize->add_setting( 'fl_color_palette', array(
				'type' => 'theme_mod'
			)
		);

		$wp_customize->add_control( 'fl_color_palette', array(
				'type'     => 'select',
				'section'  => 'fl_theme',
				'priority' => 10,
				'label'    => __( 'Colour palette', 'futurelab-base' ),
				'choices'  => $this->customizer_options
			)
		);

		$wp_customize->add_section( 'fl_background_theme',
			array(
				'title'       => __( 'Background style options', 'futurelab-base' ),
				'description' => __( 'Select FutureLab theme options' ),
				'priority'    => 160,
			)
		);

		$wp_customize->add_setting( 'fl_background_colour_palette', array(
				'type' => 'theme_mod'
			)
		);

		$wp_customize->add_control( 'fl_background_colour_palette', array(
				'type'     => 'select',
				'section'  => 'fl_theme',
				'priority' => 10,
				'label'    => __( 'Background Colour palette', 'futurelab-base' ),
				'choices'  => $this->background_customizer_options
			)
		);
	}

	function output_color_palette() {

		$palette = get_theme_mod( 'fl_color_palette' );
		if ( isset( $palette ) && ! empty( $palette ) ) {
			$palette_colors = $this->color_palettes[ $palette ];
		}


		$background_palette = get_theme_mod( 'fl_background_colour_palette' );
		if ( isset( $background_palette ) && ! empty( $background_palette ) ) {
			$background_palette_colors = $this->background_color_palettes[ $background_palette ];
		}


		echo '<style>' . PHP_EOL;
		echo ':root{' . PHP_EOL;

		foreach ( $palette_colors as $css_variable => $color_code ) {

			echo $css_variable . ': ' . $color_code . ';' . PHP_EOL;

		}

		foreach ( $background_palette_colors as $css_variable => $color_code ) {

			echo $css_variable . ': ' . $color_code . ';' . PHP_EOL;

		}

		echo '}' . PHP_EOL;;
		echo '</style>' . PHP_EOL;

	}
}

add_action( 'init', array( 'FutureLab\custom_color_palette', 'init' ) );



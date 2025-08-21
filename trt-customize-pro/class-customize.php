<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class realestate_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'trt-customize-pro/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'realestate_Customize_Section_Pro' );
	//	$manager->register_section_type( 'control-section-realestate' );

		// Register sections.
		$manager->add_section(
			new realestate_Customize_Section_Pro(
				$manager,
				'guide',
				array(
					'title'    => esc_html__( 'Online Guide', 'real-estate-right-now' ),
					'pro_text' => esc_html__( 'Go', 'real-estate-right-now' ),
					'pro_url'  => 'https://realestatetheme.eu/help/index.php'
				)
			)
		);
  		// Register custom section types.
	//	$manager->register_section_type( 'Example_1_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new realestate_Customize_Section_Pro(
				$manager,
				'pro',
				array(
					'title'    => esc_html__( 'Pro Version', 'realestate' ),
					'pro_text' => esc_html__( 'Go',         'realestate' ),
					'pro_url'  => 'https://siterightaway.net/real-estate-premium-theme/'
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		// die(var_dump(__LINE__));

		//wp_register_style( 'realestate-customize-controls-style', trailingslashit( get_template_directory_uri() ) . 'trt-customize-pro/customize-controls.css' , array(), '', true );
      //  wp_enqueue_style( 'realestate-customize-controls-style');


		wp_enqueue_script( 'realestate-customize-controls', trailingslashit( get_template_directory_uri() ) . 'trt-customize-pro/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style(  'realestate-customize-controls', trailingslashit( get_template_directory_uri() ) . 'trt-customize-pro/customize-controls.css' );

	}
}

// Doing this customizer thang!
realestate_Customize::get_instance();

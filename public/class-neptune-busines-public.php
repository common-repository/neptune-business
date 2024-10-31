<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://themespla.net
 * @since      1.0.0
 *
 * @package    Neptune_Busines
 * @subpackage Neptune_Busines/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Neptune_Busines
 * @subpackage Neptune_Busines/public
 * @author     Mike Aggrey <mike@themespla.net>
 */
class Neptune_Busines_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Neptune_Busines_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Neptune_Busines_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/neptune-busines-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Neptune_Busines_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Neptune_Busines_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/neptune-busines-public.js', array( 'jquery' ), $this->version, false );

		//GOOGLE MAPS API
		$maps = get_option( 'neptune_google_map_api_key' );
		$mapsapi = "https://maps.googleapis.com/maps/api/js?libraries=places&key=" . ($maps);
		wp_enqueue_script( 'neptune-google-maps', $mapsapi ,false );
		wp_enqueue_script( 'gmaps', plugin_dir_url( __FILE__ ) . 'js/google-maps.js', array( 'jquery' ), 982060008, false );

	}

}

<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themespla.net
 * @since      1.0.0
 *
 * @package    Neptune_Busines
 * @subpackage Neptune_Busines/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Neptune_Busines
 * @subpackage Neptune_Busines/includes
 * @author     Mike Aggrey <mike@themespla.net>
 */
class Neptune_Busines {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Neptune_Busines_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'NEPTUNE_BUSINESS' ) ) {
			$this->version = NEPTUNE_BUSINESS;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'neptune-busines';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->neptune_load_libraries();
		$this->neptune_functions();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Neptune_Busines_Loader. Orchestrates the hooks of the plugin.
	 * - Neptune_Busines_i18n. Defines internationalization functionality.
	 * - Neptune_Busines_Admin. Defines all hooks for the admin area.
	 * - Neptune_Busines_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-busines-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-busines-i18n.php';


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-neptune-business-functions.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-neptune-busines-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'templates/class-neptune-business-template.php';
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-neptune-busines-public.php';

		$this->loader = new Neptune_Busines_Loader();

	}
	private function neptune_load_libraries(){

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/libraries/tgm/class-tgm-plugin-activation.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/config/acf-fields.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Neptune_Busines_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Neptune_Busines_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Neptune_Busines_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Neptune_Busines_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}
	private function neptune_functions() {
		$functions = new Neptune_Business_Functions();
		$this->loader->add_action( 'tgmpa_register', $functions, 'neptune_tgm' );
		$this->loader->add_action('admin_notices', $functions , 'neptune_wp_theme_check', 20);
		$this->loader->add_action('admin_notices', $functions , 'neptune_wp_upgrade', 20);
		$this->loader->add_action('admin_menu', $functions, 'neptune_wp_google_api_menu',20);	
		$this->loader->add_filter( 'pt-ocdi/import_files',$functions, 'neptune_demo_import' );
		$this->loader->add_action( 'pt-ocdi/after_import',$functions, 'neptune_after_import_setup' );
	}
	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Neptune_Busines_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

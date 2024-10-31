<?php
class Neptune_Business_Functions {

	public function __construct() {
    }
    public function neptune_wp_theme_check() {
		$theme = wp_get_theme(); // gets the current theme
		$url = 'https://neptunewp.com/downloads/neptune-wp/';
        if ( 'Neptune WP' == $theme->name || 'neptune-wp' == $theme->parent_theme ) {
            
            echo '<div class="notice notice-success is-dismissible neptune-notice"><p>';
				printf( esc_html__("Neptune WP Theme & Plugin Activated, Get setup instructions %s!", "neptune-business"), '<a href="https://desk.zoho.com/portal/neptunewp/home">here</a>' );
            echo '</p></div>';
        }else {
            
            echo '<div class="notice notice-error is-dismissible neptune-notice"><p>';
				printf( esc_html__("Its Recomended to use the free theme %s Neptune WP for better results","neptune-business"), '<a href="https://neptunewp.com/downloads/neptune-wp">Neptune Business</a>' );
			echo '</p></div>';
            
         }
    }

    public function neptune_wp_upgrade() {
        if (!class_exists('Neptune_Pro')){
            echo '<div class="notice notice-success is-dismissible neptune-notice neptune-upgrade"><p>';
 
                printf( esc_html__("Get all the features like Portfolios, testimonials, Teams and 3 more demo installs %s for just $49 ,get 20&#37; off if you use this code neptune20","neptune-business"), '<a href="https://neptunewp.com/downloads/neptune-wp">GO PRO</a>' );
            echo '</p></div>';            
        }
	}
    public function neptune_tgm(){
    		/*
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	
	
		// Include ACF PRO via TGM to save space, plugin is bloated enough.
		array(
			'name'               => 'Advanced Custom Fields', // The plugin name.
			'slug'               => 'advanced-custom-fields', // The plugin slug (typically the folder name).
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
	
		),
		array(
			'name'               => 'One Click Demo Import', // The plugin name.
			'slug'               => 'one-click-demo-import', // The plugin slug (typically the folder name).
			'required'           => false, // If false, the plugin is only 'recommended' instead of required.
		),
		);
	
		/*
		 * Array of configuration settings. Amend each line as needed.
		 *
		 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
		 * strings available, please help us make TGMPA even better by giving us access to these translations or by
		 * sending in a pull-request with .po file(s) with the translations.
		 *
		 * Only uncomment the strings in the config array if you want to customize the strings.
		 */
		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
			/*
			'strings'      => array(
				'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
				'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
				// <snip>...</snip>
				'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
			)
			*/
		);
		tgmpa( $plugins, $config );
    }

    	public function neptune_wp_google_api_menu() {
		add_submenu_page( 
			'options-general.php', 
			'Google API KEY', 
			'Google API KEY', 
			'manage_options', 
			'google_maps_api_key', 
			array(&$this,'neptune_wp_api_page' )
		);
	}
	public function neptune_wp_api_page() { 
		add_thickbox();
		$updated = false;
		if ( isset( $_POST['neptune_google_map_api_key'] ) ) {
			$key     = esc_attr( $_POST['neptune_google_map_api_key'] );
			$updated = update_option( 'neptune_google_map_api_key', $key );
		}
	
		if ( $updated ) {
			echo '<div class="updated fade"><p><strong>' . __( 'Key Updated!', 'gmaps-api-key' ) . '</strong></p></div>';
	
		}
		?>
			<h2><?php _e( 'Google Maps API KEY', 'neptune_real_estate' ); ?></h2>
		<p><?php _e( 'You need to get a Google Maps API KEY in order for the Maps to work,', 'neptune_real_estate' ); ?></p>
		<p>
			<?php $gm_api_url = 'https://console.developers.google.com/henhouse/?pb=["hh-1","maps_backend",null,[],"https://developers.google.com",null,["static_maps_backend","street_view_image_backend","maps_embed_backend","places_backend","geocoding_backend","directions_backend","distance_matrix_backend","geolocation","elevation_backend","timezone_backend","maps_backend"],null]';?>
			<a id="gd-api-key" onclick='window.open("<?php echo wp_slash($gm_api_url);?>", "newwindow", "width=600, height=400"); return false;' href='<?php echo $gm_api_url;?>' class="button-primary" name="<?php _e('Generate API Key - ( MUST be logged in to your Google account )','neptune_real_estate');?>" ><?php _e('Generate API Key','neptune_real_estate');?></a>

			<?php echo sprintf( __( 'or %sclick here%s to Get a Google Maps API KEY - ( MUST be logged in to your Google account )', 'neptune_real_estate' ), '<a target="_blank" href=\'https://console.developers.google.com/flows/enableapi?apiid=static_maps_backend,street_view_image_backend,maps_embed_backend,places_backend,geocoding_backend,directions_backend,distance_matrix_backend,geolocation,elevation_backend,timezone_backend,maps_backend&keyType=CLIENT_SIDE&reusekey=true\'>', '</a>' ) ?>
		</p>
		<form method="post" action="options-general.php?page=google_maps_api_key">
			<label for="neptune_google_map_api_key"><?php _e( 'Enter Google Maps API KEY', 'neptune_real_estate' ); ?></label>
			<input title="<?php _e( 'Add Google Maps API KEY', 'neptune_real_estate' ); ?>" type="text"
			       name="neptune_google_map_api_key" id="neptune_google_map_api_key"
			       placeholder="<?php _e( 'Enter your API KEY here', 'neptune_real_estate' ); ?>"
			       style="padding: 6px; width:50%; display: block;"
			       value="<?php echo esc_attr( get_option( 'neptune_google_map_api_key' ) ); ?>"/>

			<?php

			submit_button();

			?>
		</form>
	<?php }
	function neptune_demo_import() {
	  return array(
	    array(
	      'import_file_name'             => 'Basic',
	      //'categories'                   => array( 'Category 1', 'Category 2' ),
	      'local_import_file'            => plugin_dir_path( __FILE__) . 'libraries/demo-files/basic-content.xml',
	      //'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'ocdi/widgets.json',
	      'local_import_customizer_file' => plugin_dir_path( __FILE__) . 'libraries/demo-files/basic-customizer.dat',

	      'import_preview_image_url'     => 'http://updates.neptunewp.com/neptune-wp/neptune-basic-600x900.jpg',
	      'import_notice'                => __( 'This will import pages, posts & all data, no data will be overwriten.', 'neptune-pro' ),
	      'preview_url'                  => 'basic.neptunewp.com',
	    ),
	  );
	}
	function neptune_after_import_setup() {
		// Assign menus to their locations.
		$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

		set_theme_mod( 'nav_menu_locations', array(
				'main-menu'   => $main_menu->term_id,
			)
		);

		// Assign front page and blog page.
		$front_page_id = get_page_by_title( 'Home' );

		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $front_page_id->ID );

	}
}
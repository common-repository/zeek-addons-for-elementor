<?php
/**
 * Plugin Name: Zeek Addons for Elementor
 * Description: Widgets for elementor
 * Plugin URI: https://zeek.studio/zeek-addons-for-elementor
 * Version: 1.0.0
 * Author: Zeek
 * Author URI: https://zeek.studio/
 * Text Domain: zeek-addons-for-elementor
 * License: GNU General Public License v3.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



if( ! class_exists('Zeek_Addons') ) {

/**
 * Main Zeek Addons For Elementor Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
class Zeek_Addons {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Zeek_Addons The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Zeek_Addons An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'zeek_addons_load_textdomain' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
    add_action( 'wp_enqueue_scripts', array( $this, 'zeek_addons_enqueue_scripts' ) );
    // Registering Elementor Widget Category
    add_action( 'elementor/elements/categories_registered', array( $this, 'zeek_addons_register_category' ) );

	}

  /**
  * Register Zeek Addons Elementor category
  *
  */
  public function zeek_addons_register_category( $elements_manager ) {

      $elements_manager->add_category(
          'zeek-addons-elementor',
          [
              'title' => __( 'Zeek Addons', 'zeek-addons-for-elementor' ),
              'icon' => 'fa fa-plug',
          ]
      );

  }


	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function zeek_addons_load_textdomain() {

		load_plugin_textdomain( 'zeek-addons-for-elementor' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}


		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'zeek_include_widgets' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

    $screen = get_current_screen();
    if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
        return;
    }

    $plugin = 'elementor/elementor.php';

    if ( $this->_is_elementor_installed() ) {
        if ( ! current_user_can( 'activate_plugins' ) ) { return; }
        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
        $admin_message = '<p>' . esc_html__( 'Opps! Zeek Addons requires Elementor to be activated first.', 'zeek-addons-for-elementor' ) . '</p>';
        $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, esc_html__( 'Activate Elementor Now', 'zeek-addons-for-elementor' ) ) . '</p>';
    } else {
        if ( ! current_user_can( 'install_plugins' ) ) { return; }
        $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
        $admin_message = '<p>' . esc_html__( 'Opps! Zeek Addons not working because you need to install the Elementor', 'zeek-addons-for-elementor' ) . '</p>';
        $admin_message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, esc_html__( 'Install Elementor Now', 'zeek-addons-for-elementor' ) ) . '</p>';
    }

    echo '<div class="error">' . $admin_message . '</div>';
	}


  // Include css files
  public function zeek_addons_enqueue_scripts() {
      wp_enqueue_style( 'zeek-main-style', plugin_dir_url( __FILE__ ) . 'assets/css/zeek-addons-main.css' );
  }

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function zeek_include_widgets() {

		// Include Widget files
		require_once( __DIR__ . '/widgets/zeek-button.php' );

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Zeek_Button() );

	 }
    /**
    * Check the elementor installed or not
    */
    public function _is_elementor_installed() {
        $file_path = 'elementor/elementor.php';
        $installed_plugins = get_plugins();

        return isset( $installed_plugins[ $file_path ] );
    }
  }
}

Zeek_Addons::instance();

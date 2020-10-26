<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/c-exe
 * @since      1.0.1
 *
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
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
 * @since      1.0.1
 * @package    Ranchoimggen
 * @subpackage Ranchoimggen/includes
 * @author     C Collingridge <chriscollingridge@oakleaf-enterprise.org>
 */
class Ranchoimggen {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ranchoimggen_Loader    $loader    Maintains and registers all hooks for the plugin.
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
	 * @since    1.0.1
	 */
	public function __construct() {
		if ( defined( 'RANCHOIMGGEN_VERSION' ) ) {
			$this->version = RANCHOIMGGEN_VERSION;
		} else {
			$this->version = '1.0.1';
		}
		$this->plugin_name = 'ranchoimggen';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	
	public static function ranchoimggen_shortcode( $atts = [], $content = null)
	{
    	// do something to $content
 	   // always return
 	   $options = get_option('ranchoimggen');//$this->plugin_name);
	   //return $content;
	   $numshown = $options['numshown'];
       $listimg = $options['listimg'];
	   $urls = explode("\n",chop($listimg));
	   $iwidth = floor(90 / (($numshown < 8) ? $numshown : 7 ));
	   $numurls = count($urls);
		$content = "";
	   if ($numurls >= $numshown)
	   {
	     for ($i = 0; $i<$numshown; $i++)
		 {
		   $numurls = count($urls);
	       $rnd = floor(mt_rand(0,$numurls-1));
			 $content .= "$rnd:";
		   $rurl[$i] = chop($urls[$rnd]);
			 $content .= "[";
			 $k=0;
			 for ($j=0;$j<$numurls;$j++)
			 {
				 if ($j!=$rnd)
				 {
				     $content .= "$k=$j(" . chop($urls[$j]) . ");";
					 $nurls[$k]=$urls[$j];
			         $k++;
				 }
			 }
		   //unset($urls[$rnd]);
		   $content .= "]";
		   unset($urls);
		   $urls = $nurls;
		   unset($nurls);
		   $nurls = array();
		   $numurls = count($urls);
		 }
		 $numurls = count($rurl);
	   }
	   else
	   {
	     $rurl = $urls;
		 $numurls = count($urls);
	   }
	   $content = "<div class=\"RanChoImgGenBackground\" style=\"background-color: #FFFFAA; border-color: #000000; text-align: center; \">\n";
	   for ($i = 0; $i<$numurls; $i++)
	   {
	     $content .= "<img src=\"" . htmlspecialchars($rurl[$i]) . "\" width=\"$iwidth%\" height=\"auto\" class=\"RanChoImgGenImage\" />&nbsp;";
	   }
	   $content .= "\n</div>";
 	   return $content;
	}
	

	
	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ranchoimggen_Loader. Orchestrates the hooks of the plugin.
	 * - Ranchoimggen_i18n. Defines internationalization functionality.
	 * - Ranchoimggen_Admin. Defines all hooks for the admin area.
	 * - Ranchoimggen_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ranchoimggen-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ranchoimggen-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ranchoimggen-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ranchoimggen-public.php';

		$this->loader = new Ranchoimggen_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ranchoimggen_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ranchoimggen_i18n();

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

		$plugin_admin = new Ranchoimggen_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
		
		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );
		
		$this->loader->add_action('admin_init', $plugin_admin, 'options_update');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ranchoimggen_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		add_shortcode('ranchoimggen', 'Ranchoimggen::ranchoimggen_shortcode');

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
	 * @return    Ranchoimggen_Loader    Orchestrates the hooks of the plugin.
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

<?php 
/**
 * Plugin Name: My portfolio configuration panel for black & white theme 
 * 
 * Description: Adds custom configuration fields 
 * 
 * Version: 1.0.0 
 * 
 * Author URI: mathieuraimbault.dev
 * 
 * Text Domain: my-portfolio-configuration-panel
 */


require_once(plugin_dir_path( __FILE__ ).'constant.php');
require_once(plugin_dir_path( __FILE__ ).'inc/DbLinker.php');
require_once(plugin_dir_path( __FILE__ ).'inc/Form.php');
require_once(plugin_dir_path( __FILE__ ).'inc/StylesheetGenerator.php');


/**
 * Generate CSS static file
 */

function portfolio_generate_css_file ($arg) {
    $dbLinker = new \PortfolioPlugin\DBLinker(P_AUTHOR_DATA, P_THEME_DATA);
    $dbLinker->updateThemeData();
    \PortfolioPlugin\StylesheetGenerator::generateStaticFile($dbLinker->getThemeData());
}

 /**
  * register settings
  */
function portfolio_register_stettings() {
    foreach (P_AUTHOR_DATA as $k => $auth) {
        register_setting(PLUGIN_SLUG, $k, [
            'type' => $auth["type"],
            'default' => $auth['value'],
        ]);
    }
    foreach(P_THEME_DATA as $k =>  $theme) {
        register_setting(PLUGIN_SLUG,$k, ["type" => "string", "default" => $theme["value"]]);
    }
}


 /**
  * load scripts and stylesheets
  */
function portfolio_config_scripts($hook) {
    wp_enqueue_style(PLUGIN_SLUG . "-custom-style", plugins_url('style/custom-style.css', __FILE__));
    if($hook !== "toplevel_page_" . PLUGIN_SLUG) {
        return;
    }
    wp_enqueue_style(PLUGIN_SLUG . "-admin-style", plugins_url('style/admin-style.css', __FILE__));

}

/**
 * load view
 */
function portfolio_config_content() {
	require_once(plugin_dir_path( __FILE__ ).'inc/panel.php');
}

/**
 * add to menu
 */
function my_port_config_menu() {
    add_menu_page("Configurations générales", "Configurations générales", "manage_options", PLUGIN_SLUG, "portfolio_config_content", "dashicons-admin-users", 1);
}

/**
 * Add actions
 */
add_action('admin_menu', 'my_port_config_menu' );
add_action('admin_enqueue_scripts', 'portfolio_config_scripts');
add_action('admin_init', 'portfolio_register_stettings');
add_action('updated_option', 'portfolio_generate_css_file');

<?php /**
 * Plugin Name: Synkraft Woocommerce Popup
 * Plugin URI: https://synkwoopopup/
 * Description: This plugin is essential for configure popup for all woocommerce products.
 * Version: 0.01
 * Author: Popup , Woo Popup, Popups
 * Author URI: https://synkwoopopup/
 * Text Domain: synkwoopop
 * Requires at least:Synk_Pop_Admin_main
 * Requires PHP:synk_pop_settings_fun
 */

//Exit if accessed directly
if(!defined('ABSPATH')){
    return;
}
define("SYNKWOO_POP_PATH", plugin_dir_path(__FILE__));
define("SYNKWOO_POP_URL", plugins_url('',__FILE__));
define("SYNKWOO_POP_VERSION",0.01);

class Synkraft_Woo_Popup{
    protected static $instance = null;

    //Get instance
    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function __construct(){
        include_once SYNKWOO_POP_PATH.'/admin/synk-pop-admin.php';
        Synk_Pop_Admin_main::get_instance();
        require_once SYNKWOO_POP_PATH.'/classes/inc/class-synkwoo-pop.php';
        Synkwoo_Pop::get_instance();
        //this is old one hook
        //add_action('plugins_loaded',array($this,'synkwoo_pop_atcem_value'));
        $this->synkwoo_pop_atcem_value();
    }

    function synkwoo_pop_atcem_value(){
    //global $synk_pop_gl_atcem_value;
    $synk_pop_gl_atcem_value = sanitize_text_field(get_option('synk-pop-gl-atcem','true'));
    //If mobile
    if(!$synk_pop_gl_atcem_value){
        if(wp_is_mobile()){
            return;
        }
    }
   // global $synkwoo_pop_atcem_value;

}








}

Synkraft_Woo_Popup::get_instance();
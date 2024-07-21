<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
    return;
}
class Synk_Pop_Admin_main
{
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
        add_action('admin_enqueue_scripts', array($this,'synk_pop_admin_enqueue'));
        add_action('admin_menu', array($this,'synk_pop_menu_settings'));
    }
    function synk_pop_admin_enqueue()
    {
        wp_enqueue_style('synk-cp-admin-css', SYNKWOO_POP_URL . '/admin/assets/css/synk-pop-admin-css.css', null, SYNKWOO_POP_VERSION);
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('xoo-cp-admin-js', SYNKWOO_POP_URL . '/admin/assets/js/synk-pop-admin-js.js', array('jquery', 'wp-color-picker'), SYNKWOO_POP_VERSION, true);
    }
    function synk_pop_menu_settings(){
        add_menu_page('Synkraft cart popup', 'Synk Add2cart Popup', 'manage_options', 'synk_popup', array($this, 'synk_pop_settings_fun'), 'dashicons-lightbulb', 61);
        add_action('admin_init', array($this,'synk_pop_settings'));
    }
    function synk_pop_settings_fun(){
       include plugin_dir_path(__FILE__) . 'synk-pop-settings.php';
       Synk_Pop_Admin_settings::get_instance();
    }
        function synk_pop_settings()
        {
            //General options
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-atcem'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-pden'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-ibtne'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-qtyen'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-vcbtne'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-chbtne'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-spinen'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-gl-resetbtn'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-pw'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-imgw'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-btnc'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-btnbg'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-btnhover'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-btnhoverborder'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-btns'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-btnbr'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-tbs'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-tbc'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-popbg'
            );
            register_setting(
                'synk-pop-group',
                'synk-pop-sy-popborder'
            );
            /** Settings Section **/
            add_settings_section(
                'synk-pop-gl',
                '',
                array($this,'synk_pop_gl_cb'),
                'synk_popup'
            );
            add_settings_section(
                'synk-pop-sy',
                '',
                array($this,'synk_pop_sy_cb'),
                'synk_popup'
            );
            add_settings_section(
                'synk-pop-endad',
                '',
                array($this,'synk_pop_endad_cb'),
                'synk_popup'
            );
            add_settings_field(
                'synk-pop-gl-atcem',
                'Enable on Mobile',
                array($this,'synk_pop_gl_atcem_cb'),
                'synk_popup',
                'synk-pop-gl'
            );
            add_settings_field(
                'synk-pop-gl-pden',
                'Show product details',
                array($this,'synk_pop_gl_pden_cb'),
                'synk_popup',
                'synk-pop-gl'
            );
            add_settings_field(
                'synk-pop-gl-ibtne',
                '+/- Qty Button',
                array($this,'synk_pop_gl_ibtne_cb'),
                'synk_popup',
                'synk-pop-gl'
            );
            add_settings_field(
                'synk-pop-gl-qtyen',
                'Update Quantity',
                array($this,'synk_pop_gl_qtyen_cb'),
                'synk_popup',
                'synk-pop-gl'
            );
            add_settings_field(
                'synk-pop-gl-vcbtne',
                'View Cart Button',
                array($this,'synk_pop_gl_vcbtne_cb'),
                'synk_popup',
                'synk-pop-gl'
            );
            add_settings_field(
                'synk-pop-gl-chbtne',
                'Checkout Button',
                array($this,'synk_pop_gl_chbtne_cb'),
                'synk_popup',
                'synk-pop-gl'
            );
            add_settings_field(
                'synk-pop-sy-pw',
                'PopUp Width',
                array($this,'synk_pop_sy_pw_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-imgw',
                'Image Width',
                array($this,'synk_pop_sy_imgw_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-btnbg',
                'Button Background Color',
                array($this,'synk_pop_sy_btnbg_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-btnhover',
                'Button Background Hover',
                array($this,'synk_pop_sy_btnhver_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-btnhoverborder',
                'Button Hover Border Color',
                array($this,'synk_pop_sy_btnhverborder_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-btnc',
                'Button Text Color',
                array($this,'synk_pop_sy_btnc_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-btns',
                'Button Font Size',
                array($this,'synk_pop_sy_btns_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-btnbr',
                'Button Border Radius',
                array($this,'synk_pop_sy_btnbr_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-tbs',
                'Item Border Size',
                array($this,'synk_pop_sy_tbs_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-tbc',
                'Item Border Color',
                array($this,'synk_pop_sy_tbc_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            //popup bg color
            add_settings_field(
                'synk-pop-sy-popbg',
                'Popup Background Color',
                array($this,'synk_pop_sy_popbg_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
            add_settings_field(
                'synk-pop-sy-popupborder',
                'Popup Border Color',
                array($this,'synk_pop_sy_popupborder_cb'),
                'synk_popup',
                'synk-pop-sy'
            );
        }
        //Settings Section Callback
        function synk_pop_gl_cb(){
            $tab = '<div class="main-settings">';  //Begin Main settings
            echo $tab;
            echo '<h4>General Options</h4>';
        }
        function synk_pop_sy_cb(){
            echo '<h4>Style Options</h4>';
        }
        function synk_pop_endad_cb(){
            ob_start();
            $html  = ob_get_clean();
            $html .= '</div>'; // End Advanced settings
            echo $html;
        }
        //General Options Callback
        //Enable on Mobile Devices
        function synk_pop_gl_atcem_cb(){
            $synk_pop_gl_atcem_value = sanitize_text_field(get_option('synk-pop-gl-atcem','true'));
            if(!isset($synk_pop_gl_atcem_value)){
                $synk_pop_gl_atcem_value="true";
            }
            $html  = '<input type="checkbox" class="form-check-input" name="synk-pop-gl-atcem" id="synk-pop-gl-atcem" value="true"'.checked('true',$synk_pop_gl_atcem_value,false).'>';
            $html .= '<label for="xoo-cp-gl-atcem">Enable on mobile devices.</label>';
            echo $html;
        }
        //Show product details
        function synk_pop_gl_pden_cb(){
            $synk_pop_gl_pden_value = sanitize_text_field(get_option('synk-pop-gl-pden','true'));
            if(!isset($synk_pop_gl_pden_value)){
                $synk_pop_gl_pden_value="true";
            }
            $html  = '<input type="checkbox" class="form-check-input" name="synk-pop-gl-pden" id="synk-pop-gl-pden" value="true"'.checked('true',$synk_pop_gl_pden_value,false).'>';
            $html .= '<label for="synk-pop-gl-pden"> Show product name/image/quantity.</label>';
            echo $html;
        }
        //Enable +/- button
        function synk_pop_gl_ibtne_cb(){
            $synk_pop_gl_ibtne_value = sanitize_text_field(get_option('synk-pop-gl-ibtne','true'));
            if(!isset($synk_pop_gl_ibtne_value)){
                $synk_pop_gl_ibtne_value="true";
            }
            $html  = '<input type="checkbox" class="form-check-input" name="synk-pop-gl-ibtne" id="synk-pop-gl-ibtne" value="true"'.checked('true',$synk_pop_gl_ibtne_value,false).'>';
            $html .= '<label for="synk-pop-gl-ibtne"> Enable Increase/Decrease Quantity buttons.</label>';
            echo $html;
        }
        //Allow Quantity Update
        function synk_pop_gl_qtyen_cb(){
            $synk_pop_gl_qtyen_value = sanitize_text_field(get_option('synk-pop-gl-qtyen','true'));
            if(!isset($synk_pop_gl_qtyen_value)){
                $synk_pop_gl_qtyen_value="true";
            }
            $html  = '<input type="checkbox" class="form-check-input" name="synk-pop-gl-qtyen" id="synk-pop-gl-qtyen" value="true"'.checked('true',$synk_pop_gl_qtyen_value,false).'>';
            $html .= '<label for="synk-pop-gl-qtyen">Allow users to update quantity from popup.</label>';
            echo $html;
        }
        //View Cart button
        function synk_pop_gl_vcbtne_cb(){
            $synk_pop_gl_vcbtne_value = sanitize_text_field(get_option('synk-pop-gl-vcbtne','true'));
            if(!isset($synk_pop_gl_vcbtne_value)){
                $synk_pop_gl_vcbtne_value="true";
            }
            $html  = '<input type="checkbox" class="form-check-input" name="synk-pop-gl-vcbtne" id="synk-pop-gl-vcbtne" value="true"'.checked('true',$synk_pop_gl_vcbtne_value,false).'>';
            $html .= '<label for="synk-pop-gl-vcbtne">Enable View Cart button.</label>';
            echo $html;
        }
        //Checkout button
        function synk_pop_gl_chbtne_cb(){
            $synk_pop_gl_chbtne_value = sanitize_text_field(get_option('synk-pop-gl-chbtne','true'));
            if(!isset($synk_pop_gl_chbtne_value)){
                $synk_pop_gl_chbtne_value="true";
            }
            $html  = '<input type="checkbox" class="form-check-input" name="synk-pop-gl-chbtne" id="synk-pop-gl-chbtne" value="true"'.checked('true',$synk_pop_gl_chbtne_value,false).'>';
            $html .= '<label for="synk-pop-gl-chbtne">Enable Checkout button.</label>';
            echo $html;
        }
        //Style Options Callback
        //Popup Width
        function synk_pop_sy_pw_cb(){
            $synk_pop_sy_pw_value = sanitize_text_field(get_option('synk-pop-sy-pw','650'));
            if($synk_pop_sy_pw_value==""){
                $synk_pop_sy_pw_value="650";
            }
            $html  = '<input type="number"  name="synk-pop-sy-pw" id="synk-pop-sy-pw" value="'.$synk_pop_sy_pw_value.'">';
            $html .= '<label for="synk-pop-sy-pw">Value in px (Default: 650).</label>';
            echo $html;

        }
        //Image Width
        function synk_pop_sy_imgw_cb(){
            $synk_pop_sy_imgw_value = sanitize_text_field(get_option('synk-pop-sy-imgw','20'));
            if($synk_pop_sy_imgw_value==""){
                $synk_pop_sy_imgw_value="20";
            }
            $html  = '<input type="number"  name="synk-pop-sy-imgw" id="synk-pop-sy-imgw" value="'.$synk_pop_sy_imgw_value.'">';
            $html .= '<label for="synk-pop-sy-imgw">Value in percentage (Default: 20).</label>';
            echo $html;
        }
        //Button Background Color
        function synk_pop_sy_btnbg_cb(){
            $synk_pop_sy_btnbg_value = sanitize_text_field(get_option('synk-pop-sy-btnbg','#81d742'));
            if($synk_pop_sy_btnbg_value==""){
                $synk_pop_sy_btnbg_value="#81d742";
            }
            $html  = '<input type="text" name="synk-pop-sy-btnbg" id="synk-pop-sy-btnbg" class="color-field" value="'.$synk_pop_sy_btnbg_value.'">';
            echo $html;
        }
        //Button Hover Background Color
        function synk_pop_sy_btnhver_cb(){
            $synk_pop_sy_btnhover_value = sanitize_text_field(get_option('synk-pop-sy-btnhover','#7cb538'));
            if($synk_pop_sy_btnhover_value==""){
                $synk_pop_sy_btnhover_value="#7cb538";
            }
            $html  = '<input type="text" name="synk-pop-sy-btnhover" id="synk-pop-sy-btnhover" class="color-field" value="'.$synk_pop_sy_btnhover_value.'"';
            echo $html;
        }
        //Button Hover Border color
        function synk_pop_sy_btnhverborder_cb(){
            $synk_pop_sy_btnhoverborder_value = sanitize_text_field(get_option('synk-pop-sy-btnhoverborder','#7cb538'));
            if($synk_pop_sy_btnhoverborder_value==""){
                $synk_pop_sy_btnhoverborder_value="#7cb538";
            }
            $html  = '<input type="text" name="synk-pop-sy-btnhoverborder" id="synk-pop-sy-btnhoverborder" class="color-field" value="'.$synk_pop_sy_btnhoverborder_value.'"';
            echo $html;
        }
        //Button text Color
        function synk_pop_sy_btnc_cb(){
            $synk_pop_sy_btnc_value = sanitize_text_field(get_option('synk-pop-sy-btnc','#ffffff'));
            if($synk_pop_sy_btnc_value==""){
                $synk_pop_sy_btnc_value="#ffffff";
            }
            $html  = '<input type="text" name="synk-pop-sy-btnc" id="synk-pop-sy-btnc" class="color-field" value="'.$synk_pop_sy_btnc_value.'"';
            echo $html;
        }
        //Button Font Size
        function synk_pop_sy_btns_cb(){
            $synk_pop_sy_btns_value = sanitize_text_field(get_option('synk-pop-sy-btns','14'));
            if($synk_pop_sy_btns_value==""){
                $synk_pop_sy_btns_value="14";
            }
            $html  = '<input type="number" name="synk-pop-sy-btns" id="synk-pop-sy-btns" value="'.$synk_pop_sy_btns_value.'">';
            $html .= '<label for="synk-pop-sy-btns">Size in px (Default 14).</label>';
            echo $html;
        }
        //Button Border Radius
        function synk_pop_sy_btnbr_cb(){
            $synk_pop_sy_btnbr_value = sanitize_text_field(get_option('synk-pop-sy-btnbr','4'));
            if($synk_pop_sy_btnbr_value==""){
                $synk_pop_sy_btnbr_value="4";
            }
            $html  = '<input type="number" name="synk-pop-sy-btnbr" id="synk-pop-sy-btnbr" value="'.$synk_pop_sy_btnbr_value.'">';
            $html .= '<label for="synk-pop-sy-btnbr">Size in px (Default 4).</label>';
            echo $html;
        }
        //Table Border Size
        function synk_pop_sy_tbs_cb(){
            $synk_pop_sy_tbs_value = sanitize_text_field(get_option('synk-pop-sy-tbs','0'));
            if($synk_pop_sy_tbs_value==""){
                $synk_pop_sy_tbs_value="0";
            }
            $html  = '<input type="number" name="synk-pop-sy-tbs" id="synk-pop-sy-tbs" value="'.$synk_pop_sy_tbs_value.'">';
            $html .= '<label for="synk-pop-sy-tbs">Size in px (Default 0).</label>';
            echo $html;
        }
        //Table Border Color
        function synk_pop_sy_tbc_cb(){
            $synk_pop_sy_tbc_value = sanitize_text_field(get_option('synk-pop-sy-tbc','#ffffff'));
            if($synk_pop_sy_tbc_value==""){
                $synk_pop_sy_tbc_value="#ffffff";
            }
            $html  = '<input type="text" class="color-field" name="synk-pop-sy-tbc" id="synk-pop-sy-tbc" value="'.$synk_pop_sy_tbc_value.'">';
            echo $html;
        }
        //popup Bacground Color
        //Popup Background Color
        function synk_pop_sy_popbg_cb(){
            $synk_pop_sy_popbj_value = sanitize_text_field(get_option('synk-pop-sy-popbg','#fff'));
           if($synk_pop_sy_popbj_value==""){
               $synk_pop_sy_popbj_value="#fff";
           }
            $html  = '<input type="text" name="synk-pop-sy-popbg" id="synk-pop-sy-popbg" class="color-field" value="'.$synk_pop_sy_popbj_value.'">';
            echo $html;
        }
        //Popup border color
        function synk_pop_sy_popupborder_cb(){
            $synk_pop_sy_popupborder_value = sanitize_text_field(get_option('synk-pop-sy-popborder','#f4f4f4'));
            if($synk_pop_sy_popupborder_value==""){
                $synk_pop_sy_popupborder_value="#f4f4f4";
            }
            $html  = '<input type="text" name="synk-pop-sy-popborder" id="synk-pop-sy-popborder" class="color-field" value="'.$synk_pop_sy_popupborder_value.'">';
            echo $html;
        }
}

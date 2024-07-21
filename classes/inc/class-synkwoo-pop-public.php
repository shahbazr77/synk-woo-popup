<?php
//Exit if accessed directly
if(!defined('ABSPATH')){
    return;
}

class Synk_Pop_Public{

    protected static $instance = null;

    public function __construct(){
          add_action('wp_enqueue_scripts',array($this,'synk_woo_pop_enqueue_scripts'));
          add_action('wp_footer',array($this,'synk_popup_markup'));
          add_filter( 'pre_option_woocommerce_cart_redirect_after_add', array($this,'prevent_cart_redirect'),10,1);

//        add_action('plugins_loaded',array($this,'synk_woo_load_txt_domain'),99);

        $this->synk_woo_load_txt_domain();

    }

    //Get class instance
    public static function get_instance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    //Inline styles from cart popup settings
    public static function get_inline_styles(){
       // global $synk_pop_sy_pw_value,$synk_pop_sy_imgw_value,$synk_pop_sy_btnbg_value,$synk_pop_sy_btnhover_value,$synk_pop_sy_btnhoverborder_value,$synk_pop_sy_btnc_value,$synk_pop_sy_popbj_value,$synk_pop_sy_popupborder_value,$synk_pop_sy_btns_value,$synk_pop_sy_btnbr_value,$synk_pop_sy_tbc_value,$synk_pop_sy_tbs_value,$synk_pop_gl_ibtne_value,$synk_pop_gl_vcbtne_value,$synk_pop_gl_chbtne_value,$synk_pop_gl_qtyen_value;
         $synk_pop_sy_pw_value=$synk_pop_sy_imgw_value=$synk_pop_sy_btnbg_value=$synk_pop_sy_btnhover_value=$synk_pop_sy_btnhoverborder_value=$synk_pop_sy_btnc_value=$synk_pop_sy_popbj_value=$synk_pop_sy_popupborder_value=$synk_pop_sy_btns_value=$synk_pop_sy_btnbr_value=$synk_pop_sy_tbc_value=$synk_pop_sy_tbs_value=$synk_pop_gl_ibtne_value=$synk_pop_gl_vcbtne_value=$synk_pop_gl_chbtne_value=$synk_pop_gl_qtyen_value="";


        $synk_pop_gl_ibtne_value = sanitize_text_field(get_option('synk-pop-gl-ibtne','true'));
        $synk_pop_gl_qtyen_value = sanitize_text_field(get_option('synk-pop-gl-qtyen','true'));
        $synk_pop_gl_vcbtne_value = sanitize_text_field(get_option('synk-pop-gl-vcbtne'));
        $synk_pop_gl_chbtne_value = sanitize_text_field(get_option('synk-pop-gl-chbtne'));
        $synk_pop_sy_pw_value = sanitize_text_field(get_option('synk-pop-sy-pw'));
        $synk_pop_sy_imgw_value = sanitize_text_field(get_option('synk-pop-sy-imgw'));
        $synk_pop_sy_btnbg_value = sanitize_text_field(get_option('synk-pop-sy-btnbg'));
        $synk_pop_sy_btnhover_value = sanitize_text_field(get_option('synk-pop-sy-btnhover'));
        $synk_pop_sy_btnhoverborder_value = sanitize_text_field(get_option('synk-pop-sy-btnhoverborder'));
        $synk_pop_sy_btnc_value = sanitize_text_field(get_option('synk-pop-sy-btnc'));
        $synk_pop_sy_btns_value = sanitize_text_field(get_option('synk-pop-sy-btns'));
        $synk_pop_sy_btnbr_value = sanitize_text_field(get_option('synk-pop-sy-btnbr'));
        $synk_pop_sy_tbs_value = sanitize_text_field(get_option('synk-pop-sy-tbs'));
        $synk_pop_sy_tbc_value = sanitize_text_field(get_option('synk-pop-sy-tbc'));
        $synk_pop_sy_popbj_value = sanitize_text_field(get_option('synk-pop-sy-popbg'));
        $synk_pop_sy_popupborder_value = sanitize_text_field(get_option('synk-pop-sy-popborder'));

        $style = '';

        if(!$synk_pop_gl_vcbtne_value){
            $style .= 'a.synk-pop-btn-vc{
				display: none;
			}';
        }

        if(!$synk_pop_gl_ibtne_value){
            $style .= 'span.synk-chng{
				display: none;
			}';
        }

        if(!$synk_pop_gl_chbtne_value){
            $style .= 'a.synk-pop-btn-ch{
				display: none;
			}';
        }

        if($synk_pop_gl_qtyen_value && $synk_pop_gl_ibtne_value){
            $style .= 'td.synk-pop-pqty{
			    min-width: 120px;
			}';
        }
        else{

        }

        $style.= "
			.synk-pop-container{
				max-width: {$synk_pop_sy_pw_value}px;
				background-color: {$synk_pop_sy_popbj_value};
				border-color:{$synk_pop_sy_popupborder_value};
			}
			.synk-btn{
				background-color: {$synk_pop_sy_btnbg_value};
				color: {$synk_pop_sy_btnc_value};
				font-size: {$synk_pop_sy_btns_value}px;
				border-radius: {$synk_pop_sy_btnbr_value}px;
				border: 1px solid {$synk_pop_sy_btnbg_value};
			}
			.synk-btn:hover{
				color: {$synk_pop_sy_btnc_value};
				background-color:{$synk_pop_sy_btnhover_value};
				border-color:{$synk_pop_sy_btnhoverborder_value};
			}
			td.synk-pop-pimg{
				width: {$synk_pop_sy_imgw_value}%;
			}
			table.synk-pop-pdetails , table.synk-pop-pdetails tr{
				border: 0!important;
			}
			table.synk-pop-pdetails td{
				border-style: solid;
				border-width: {$synk_pop_sy_tbs_value}px;
				border-color: {$synk_pop_sy_tbc_value};
			}";

        return $style;
    }


    //enqueue stylesheets & scripts
    public function synk_woo_pop_enqueue_scripts(){
        wp_enqueue_style('synk-woo-pop-style',SYNKWOO_POP_URL.'/assets/css/synk-woo-pop-style.css',null,SYNKWOO_POP_VERSION);
        wp_enqueue_script('synk-woo-pop-js',SYNKWOO_POP_URL.'/assets/js/synk-woo-pop.js',array('jquery'),SYNKWOO_POP_VERSION,true);
        wp_localize_script('synk-woo-pop-js','synk_woo_pop_localize',array(
            'adminurl'     		=> admin_url().'admin-ajax.php',
            'homeurl' 			=> get_bloginfo('url'),
            'wc_ajax_url' 		=> WC_AJAX::get_endpoint( "%%endpoint%%" ),
        ));
        wp_add_inline_style('synk-woo-pop-style',self::get_inline_styles());

    }

    //Load text domain
    public function synk_woo_load_txt_domain(){
        $domain = 'synk-woo-popup';
        load_plugin_textdomain( $domain, FALSE, basename(SYNKWOO_POP_PATH ) . '/languages/' );
    }

    //Get popup markup
    public function synk_popup_markup(){
        if(is_cart() || is_checkout()){return;}
        wc_get_template('synk-woo-popup-template.php','','',SYNKWOO_POP_PATH.'/templates/');
    }
    //Prevent cart redirect
    public function prevent_cart_redirect($value){
        if(!is_admin()){
            return 'no';
        }

        return $value;
    }
}
?>
<?php
if(!defined('ABSPATH')){
    return;
}
class Synk_Pop_Admin_settings{
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
       settings_errors(); ?>
        <div class="synk-container">
        <div class="synk-main">
            <form method="POST" action="options.php" class="synk-pop-form">
                <?php settings_fields('synk-pop-group'); ?>
                <?php do_settings_sections('synk_popup'); ?>
                <?php submit_button(); ?>
            </form>
        </div>
        </div>
  <?php

    }

}



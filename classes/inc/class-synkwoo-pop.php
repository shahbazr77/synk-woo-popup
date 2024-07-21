<?php

if (!defined('ABSPATH'))
    return;


class Synkwoo_Pop
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

    public function __construct()
    {
        include_once SYNKWOO_POP_PATH . '/classes/inc/class-synkwoo-pop-public.php';
        Synk_Pop_Public::get_instance();
        //Core functions
        include_once SYNKWOO_POP_PATH . '/classes/inc/class-synkwoo-pop-core.php';
        Synk_Pop_Core::get_instance();

    }

}


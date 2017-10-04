<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . "/class-woo-user-cupom-admin-panel.php";


class Woo_User_Cupom {
    public static $instance;
    public $slug = "woouc_";

    public static function getInstante()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function __construct()
    {
        new WooUserCupomAdminPanel($this->slug, "WooUserCupom", "woo_user_cupom_config");
    }
}

Woo_User_Cupom::getInstante();
<?php
require_once __DIR__ . "/class-plugin-base.php";

class WooUserCupomAdminPanel extends PluginBase {
    private $menu_id = 'woo_user_cupom_list';
    private $page_path = __DIR__ . "/../template/settings_page.php";

    public function __construct($slug = '', $menu_title, $menu_id)
    {
        $this->
        $this->slug = $slug;
        $this->menu_title = $menu_title;

        if (isset($menu_id)) {
            $this->menu_id = $menu_id;
        }
    }
}
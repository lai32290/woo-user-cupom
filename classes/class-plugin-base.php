<?php

if ( ! defined('ABSPATH') ) exit;

class PluginBase {
    public $menu_id = '';
    public $menu_title;
    public $slug;
    public $fields = [];
    public $checkbox_fields = [];
    public $page_path;

    public function __construct()
    {
        add_action('admin_menu', [$this, 'menu']);
    }

    public function renderView($view, $values = [])
    {
        extract($values);
        require_once $view;
    }

    public function get_option($option)
    {
        $slug = isset($this->slug) ? $this->slug : '';
        return get_option($slug . $option);
    }

    public function update_option($option, $value)
    {
        $slug = isset($this->slug) ? $this->slug : '';
        update_option($slug . $option, $value);
    }

    public function menu() {
        add_menu_page($this->menu_title, $this->menu_title, 'manage_options', $this->menu_id);
        add_submenu_page(
            $this->menu_id,
            $this->menu_title,
            $this->menu_title,
            'manage_options',
            $this->menu_id,
            [$this, 'load_page']
        );
    }

    public function load_page()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->update();
        }

        $this->page();
    }

    public function update() {
        $values = array_reduce(self::$fields, function ($curr, $next) {
            if (isset($_POST[$next])) {
                $curr[$next] = $_POST[$next];
            }
            return $curr;
        }, []);

        foreach (self::$checkbox_fields as $checkbox) {
            $values[$checkbox] = isset($_POST[$checkbox]);
        }

        foreach ($values as $key => $value) {
            $this->update_option($key, $value);
        }
    }

    public function page() {
        $values = $this->get_values();

        $this->renderView($this->page_path, $values);
    }
}
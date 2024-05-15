<?php

namespace App\Service;

class UrlService 
{
    private static string $assets_path = "/assets";
    private readonly string $css_base_url;
    private readonly string $js_base_url;
    private readonly string $img_base_url;
    
    function __construct() 
    {
        $this->css_base_url = self::$assets_path . "/css";
        $this->js_base_url = self::$assets_path . "/js";
        $this->img_base_url = self::$assets_path . "/img";
    }

    public function get_css_url(string $css_file) : string
    {
        return $this->css_base_url . "/" . $css_file;
    }

    public function get_js_url(string $js_file) : string
    {
        return $this->js_base_url . "/" . $js_file;
    }

    public function get_img_url(string $img_file) : string
    {
        return $this->img_base_url . "/" . $img_file;
    }
}

?>
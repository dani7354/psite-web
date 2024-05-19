<?php
    namespace App\Service\Interface;

    interface UrlServiceInterface
    {
        public function get_css_url(string $css_file) : string;
        public function get_js_url(string $js_file) : string;
        public function get_img_url(string $img_file) : string;
        public function get_integrity_attribute(string $file) : string;
    }

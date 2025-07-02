<?php

    namespace App\Service;

    use App\Service\Interface\UrlServiceInterface;

    class UrlService implements UrlServiceInterface
    {
        private readonly string $assets_path;
        private readonly string $css_base_url;
        private readonly string $js_base_url;
        private readonly string $img_base_url;
        private readonly array $asset_integrity_attributes;

        public function __construct()
        {
            $this->assets_path = "/assets";
            $this->css_base_url = $this->assets_path . "/css";
            $this->js_base_url = $this->assets_path . "/js";
            $this->img_base_url = $this->assets_path . "/img";

            $this->asset_integrity_attributes = [
                "project.js" => "sha256-2yU+ZElWKUczIaJGgDfY1XrVji+bVg39/nezYfKzgtQ= sha384-cjxoERXs4DmHA0/E4TYzM9YbeaUKFDg2CQxx1HLZA00XtP9xUdXZFfqKm5/m6hUu sha512-rExxCKfPmywGDZY3J2H63v4qZDOtL8tLfkAZjRw/b5LQQCZcLjF2jfpWwZ9hZ1B3igdO/D3X42KIK972KFso8w==",
                "bootstrap.bundle.js" => "sha256-tQ9c3dc1t0j9EV2Itwqx1ZK0qjrLayj0+l/lSEgU5ZM= sha384-fbuTCqrjZOrmpZbs3YVaKKzmtq9njHJsP1QQekiLtGTdTaVvQNmjGckvE0GKntvc sha512-anzvBXUS0bYdV5587BxY34tdgVGuc5jUUGIi0WopbvhzpLVLUV7ozejVnDOqdjKm3qlOf7W0II++oq9FrApXww==",
                "jquery.min.js" => "sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo= sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==",
                "bootstrap.css" => "sha256-GKEF18s44B5e0MolXAkpkqLiEbOVlKf6VyYr/G/E6pw= sha384-qAlWxD5RDF+aEdUc1Z7GR/tE4zYjX1Igo/LrIexlnzM6G63a6F1fXZWpZKSrSW86 sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==",
                "style.css" => "sha256-/hGG6VvbrROl7nKoidSlSfN95EQT6ndBcdVh4617/QM= sha384-95XAnRKooGeuyH48msPbWVmSzKNNgygH84qCUYnk8YIIDer4VpEaKD1i8BPcNLny sha512-5BwNke2Vxk0w955SdZ/taJZffhGhL0FnOPP8cWkgHXCSUJpyxCIPRaS4JzgXvhCnz8Cs3vJ6l52JgZAGEM3Hhw=="
            ];
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

        public function get_integrity_attribute(string $file) : string
        {
            if (!array_key_exists($file, $this->asset_integrity_attributes))
            {
                return "";
            }

            return $this->asset_integrity_attributes[$file];
        }
    }

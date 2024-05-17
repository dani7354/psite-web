<?php

    namespace App\Service;

    class UrlService
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
                "project.js" => "sha256-7a85swzrNF5Jm0EJBwn9zKN5uNsWvtCrkeRK8RVwMaU= sha384-rsSyLIKkW2NxHclVA3kY5fuvAFIeb9y1I8dIHbSjySt+L8u2wUXquK6Sis0wltQO sha512-9hkpRM9jMk/V+7agdG9uBPiN7rWf2bjIqXr+OiTg0Vzz4xqkhnpDPFEUG1ELxQtbRtXhlGcJudkEL9BzXmlw2A==",
                "bootstrap.bundle.js" => "sha256-mkoRoV24jV+rCPWcHDR5awPx8VuzzJKN0ibhxZ9/WaM= sha384-5xO2n1cyGKAe630nacBqFQxWoXjUIkhoc/FxQrWM07EIZ3TuqkAsusDeyPDOIeid sha512-sSOeacod972lTNk0ePyxrSSI6yoqvGRm7bbqtwqsY1r7TcdYiQn/a+KvaYQ0iacHBYE/MSEVjTNa2dglSz74vA==",
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

<?php
    namespace App\Service\Interface;

    interface CaptchaServiceInterface
    {
        public static function get_image() : string;
        public static function verify_captcha(string $captcha) : bool;
    }

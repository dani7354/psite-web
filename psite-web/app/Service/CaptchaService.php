<?php
    namespace App\Service;

    class CaptchaService
    {
        private const LENGTH = 7;
        private const CHARS = "abcdefghijklmnopqrstuvwxyz1234567890";
        private const SESSION_VARIABLE = "captcha";

        private const IMAGE_HEIGHT = 70;
        private const IMAGE_WIDTH = 100;

        public static function get_image() : string
        {
            $text = self::get_chars();
            $image = imagecreatetruecolor(self::IMAGE_WIDTH, self::IMAGE_HEIGHT);
            $white = imagecolorallocate($image, 255, 255, 255);
            $green = imagecolorallocate($image, 255, 0, 0);
            $font = 4;

            imagefill($image, 0, 0, $white);
            imagestring($image, $font, 30, 20, $text, $green);

            ob_start();
            imagepng($image);
            $image_bin = ob_get_clean();
            $image_b64 = base64_encode($image_bin);
            imagedestroy($image);

            return "data:image/png;base64," . $image_b64;
        }

        public static function get_chars() : string
        {
            $captcha_chars = "";

            for ($i = 0; $i < self::LENGTH; $i++)
            {
                $random_index = random_int(0, strlen(self::CHARS) - 1);
                $captcha_chars .= self::CHARS[$random_index];
            }

            self::set_captcha_for_session($captcha_chars);

            return $captcha_chars;
        }

        public static function verify_captcha($input) : bool
        {
            if (!isset($_SESSION[self::SESSION_VARIABLE]))
            {
                return false;
            }

            return hash_equals($_SESSION[self::SESSION_VARIABLE], $input);
        }

        private static function set_captcha_for_session($captcha)
        {
            $_SESSION[self::SESSION_VARIABLE] = $captcha;
        }
    }
<?php
    namespace App\Service;

    use App\Service\Interface\CsrfTokenServiceInterface;

    class CsrfTokenService extends CsrfTokenServiceInterface
    {
        private const TOKEN = "token";
        private const TOKEN_LENTGH = 32;

        public static function create_new_token() : string
        {
        $token = bin2hex(random_bytes(self::TOKEN_LENTGH));
        $_SESSION[self::TOKEN] = $token;

            return $token;
        }

        public static function verify_token(string $token) : bool
        {
        if (!isset($_SESSION[self::TOKEN]))
        {
            return false;
        }

            return hash_equals($_SESSION[self::TOKEN], $token);
        }
    }

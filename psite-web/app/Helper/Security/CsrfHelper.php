<?php
    namespace App\Helper\Security;
    
    class CsrfHelper
    {
        private const TOKEN = "token";

        public static function create_new_token() : string
        {
          $token = bin2hex(random_bytes(32));
          $_SESSION[self::TOKEN] = $token;

          return $token;
        }

        public static function verify_token($token) : bool
        {
          if (!isset($_SESSION[self::TOKEN]))
          {
            return false;
          }

          return hash_equals($_SESSION[self::TOKEN], $token);
        }
    }

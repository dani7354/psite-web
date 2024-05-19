<?php
    namespace App\Service\Interface;

    interface CsrfTokenServiceInterface
    {
        public static function create_new_token() : string;
        public static function verify_token(string $token) : bool;
    }

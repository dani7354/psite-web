<?php
    namespace App\Shared;

    class DatabaseInfo
    {
        public static function get_host() : string
        {
            return getenv("DB_HOST");
        }

        public static function get_port() : string
        {
            return getenv("DB_PORT");
        }

        public static function get_name() : string
        {
            return getenv("DB_NAME");
        }

        public static function get_user() : string
        {
            return getenv("DB_USER");
        }

        public static function get_password() : string
        {
            return getenv("DB_PASSWORD");
        }
    }

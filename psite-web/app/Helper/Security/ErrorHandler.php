<?php
    namespace App\Helper\Security;

    class ErrorHandler
    {
        private static $http_errors = [
            500 => "Internal server error",
            404 => "Not found",
            403 => "Forbidden",
            401 => "Unauthorized",
            400 => "Bad request"
        ];

        public static function handle_exception($exception, $response_code)
        {
               error_log("Exception: " . $exception->getMessage(), 0); // send to error log

               $response_message = self::$http_errors[$response_code];
               header($_SERVER["SERVER_PROTOCOL"] . " $response_code $response_message");
               echo "<h1>$response_code</h1>";

               exit();
        }

        public static function display_error_message($message, $response_code)
        {
            $response_message = self::$http_errors[$response_code];
            header($_SERVER["SERVER_PROTOCOL"] . " $response_code $response_message ");
            echo "<h1>$response_code $message</h1>";

            exit();
        }
    }

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

        public static function handle_exception(
            $exception,
            $response_code)
        {
               error_log("Exception: " . $exception->getMessage(), 0); // send to error log

               $response_message = self::$http_errors[$response_code];
               header($_SERVER["SERVER_PROTOCOL"] . " $response_code $response_message");
               echo "<h1>$response_code</h1>";

               exit();
        }

        public static function handle_exception_json(
            $exception,
            $response_code,
            $error_message)
        {
               error_log("Exception: " . $exception->getMessage(), 0);

               $response_message = self::$http_errors[$response_code];
               header('Content-Type: application/json');
               header($_SERVER["SERVER_PROTOCOL"] . " $response_code $response_message");

               $json_data = array("error_message" => $error_message);
               print json_encode($json_data);

               exit();
        }

        public static function display_error_message(string $message, int $response_code)
        {
            $response_message = self::$http_errors[$response_code];
            header($_SERVER["SERVER_PROTOCOL"] . " $response_code $response_message ");
            echo "<h1>$response_code $message</h1>";

            exit();
        }

        public static function display_error_message_json(
            $message,
            $response_code)
        {
            $response_message = self::$http_errors[$response_code];
            header('Content-Type: application/json');
            header($_SERVER["SERVER_PROTOCOL"] . " $response_code $response_message ");

            $json_data = array("error_message" => $message);
            print json_encode($json_data);

            exit();
        }
    }

<?php
    namespace App\Helper\Validation;

    class InputValidator
    {
        public static function is_blank($value) : bool
        {
            return !isset($value) || trim($value) === '';
        }

        public static function has_presence($value) : bool
        {
            return !self::is_blank($value);
        }

        public static function has_length_greater_than($value, $min) : bool
        {
            $length = strlen($value);

            return $length > $min;
        }

        public static function has_length_less_than($value, $max) : bool
        {
            $length = strlen($value);

            return $length < $max;
        }

        public static function has_length_exactly($value, $exact) : bool
        {
            $length = strlen($value);

            return $length == $exact;
        }

        public static function has_valid_email_format($value) : bool
        {
            $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';

            return preg_match($email_regex, $value) === 1;
        }
    }

<?php
    namespace App\Helper\Validation;

    class InputValidator
    {
        public static function is_blank(string $value) : bool
        {
            return trim($value) === '';
        }

        public static function has_presence(string $value) : bool
        {
            return !self::is_blank($value);
        }

        public static function has_length_greater_than(string $value, int $min) : bool
        {
            $length = strlen($value);

            return $length > $min;
        }

        public static function has_length_less_than(string $value, int $max) : bool
        {
            $length = strlen($value);

            return $length < $max;
        }

        public static function has_length_exactly(string $value, int $exact) : bool
        {
            $length = strlen($value);

            return $length == $exact;
        }

        public static function has_valid_email_format(string $value) : bool
        {
            $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';

            return preg_match($email_regex, $value) === 1;
        }
    }

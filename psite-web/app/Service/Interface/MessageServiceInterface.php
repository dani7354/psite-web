<?php
    namespace App\Service\Interface;

    interface MesssageServiceInterface
    {
        public static function validate(Message $message) : array;
        public function create(Message $message) : bool;
    }

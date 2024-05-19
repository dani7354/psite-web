<?php
    namespace App\Service\Interface;

    use App\Model\Message;

    interface MessageServiceInterface
    {
        public static function validate(Message $message) : array;
        public function create(Message $message) : bool;
    }

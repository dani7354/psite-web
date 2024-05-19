<?php
    namespace App\Repository\Interface;

    use App\Model\Message;

    interface MessageRepositoryInterface
    {
        public function create(Message $message) : bool;
    }

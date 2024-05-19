<?php
    namespace App\Repository\Interfaces;

    interface MessageRepositoryInterface
    {
        public function create(Message $message) : bool;
    }

<?php
    namespace App\Model;

    class Message
    {
        public function __construct(
            public readonly string $sender_name,
            public readonly string $sender_email,
            public readonly string $sender_ip,
            public readonly string $subject,
            public readonly string $body) { }
    }

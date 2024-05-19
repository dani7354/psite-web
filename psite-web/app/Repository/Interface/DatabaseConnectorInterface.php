<?php
    namespace App\Repository\Interface;

    use PDO;

    interface DatabaseConnectorInterface
    {
        public function get_connection() : PDO;
        public function close_connection(&$db) : void;
    }

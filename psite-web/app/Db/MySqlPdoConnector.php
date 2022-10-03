<?php
    namespace App\Db;

    use PDO;

    class MySqlPdoConnector
    {
        public function get_connection() : PDO
        {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT;

            return new PDO($dsn, DB_USER, DB_PASSWORD);
        }

        public function close_connection(&$db)
        {
            $db = null;
        }
    }

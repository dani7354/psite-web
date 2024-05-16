<?php
    namespace App\Db;

    use PDO;

    class MySqlPdoConnector
    {
        public function __construct(
            private readonly string $host,
            private readonly string $port,
            private readonly string $name,
            private readonly string $user,
            private readonly string $password) { }


        public function get_connection() : PDO
        {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->name . ";port=" . $this->port;

            return new PDO($dsn, $this->user, $this->password);
        }

        public function close_connection(&$db)
        {
            $db = null;
        }
    }

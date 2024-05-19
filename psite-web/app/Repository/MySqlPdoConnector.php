<?php
    namespace App\Repository;

    use PDO;
    use App\Repository\Interface\DatabaseConnectorInterface;

    class MySqlPdoConnector implements DatabaseConnectorInterface
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

        public function close_connection(&$db) : void
        {
            $db = null;
        }
    }

<?php
    namespace App\Db;

    use App\Db\MySqlPdoConnector;
    use App\Model\Project;
    use PDO;

    class ProjectDb
    {
        private $db_connector;

        public function __construct()
        {
            $this->db_connector = new MySqlPdoConnector();
        }

        public function all() : array
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->query("SELECT Id, Title, Url, Description, Image, IsVisible
            FROM Project
            WHERE IsVisible = 1
            ORDER BY OrderNumber");

            $projects = [];

            while($row = $query->fetch())
            {
                $project = new Project(
                    $row["Id"],
                    $row["Title"],
                    $row["Url"],
                    $row["Description"],
                    $row["Image"],
                    $row["IsVisible"]);

                array_push($projects, $project);
            }

            $this->db_connector->close_connection($connection);

            return $projects;
        }
    }

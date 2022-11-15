<?php
    namespace App\Db;

    use App\Db\MySqlPdoConnector;
    use App\Model\Project\Project;
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

        public function get_page(int $page_number, int $limit) : array
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->prepare("SELECT Id, Title, Url, Description, Image, IsVisible
            FROM Project
            WHERE IsVisible = 1
            ORDER BY OrderNumber LIMIT ? OFFSET ?");

            $offset = ($page_number - 1) * $limit;

            $query->bindParam(1, $limit, PDO::PARAM_INT);
            $query->bindParam(2, $offset, PDO::PARAM_INT);
            $query->execute();

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

            return $projects;
        }

        public function get_total_count() : int
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->query("SELECT COUNT(1) AS ProjectCount
            FROM Project
            WHERE IsVisible = 1");

            $project_count = 0;

            while($row = $query->fetch())
            {
                $project_count = $row["ProjectCount"];
            }

            $this->db_connector->close_connection($connection);

            return $project_count;
        }
    }

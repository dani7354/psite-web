<?php
    namespace App\Db;

    use App\Db\MySqlPdoConnector;
    use App\Model\Project\Project;
    use PDO;

    class ProjectDb
    {
        private $db_connector;

        public function __construct(string $host, string $port, string $db_name, string $user, string $password)
        {
            $this->db_connector = new MySqlPdoConnector($host, $port, $db_name, $user, $password);
        }

        public function all() : array
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->query("
            SELECT p.Id, p.Title, p.Url, p.Description, p.IsVisible, MAX(pu.UpdatedAt) as UpdatedAt
            FROM Project p
            LEFT OUTER JOIN ProjectUpdate pu ON p.Id = pu.ProjectId
            WHERE p.IsVisible = 1
            GROUP BY p.Id, p.Title, p.Url, p.Description, p.IsVisible
            ORDER BY p.OrderNumber");

            $projects = [];

            while($row = $query->fetch())
            {
                $project = new Project(
                    $row["Id"],
                    $row["Title"],
                    $row["Url"],
                    $row["Description"],
                    $row["UpdatedAt"],
                    $row["IsVisible"]);

                array_push($projects, $project);
            }

            $this->db_connector->close_connection($connection);

            return $projects;
        }

        public function get_page(int $page_number, int $limit) : array
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->prepare("
            SELECT p.Id, p.Title, p.Url, p.Description, p.IsVisible, MAX(pu.UpdatedAt) as UpdatedAt
            FROM Project p
            LEFT OUTER JOIN ProjectUpdate pu ON p.Id = pu.ProjectId
            WHERE p.IsVisible = 1
            GROUP BY p.Id, p.Title, p.Url, p.Description, p.IsVisible
            ORDER BY p.OrderNumber LIMIT ? OFFSET ?");

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
                    $row["UpdatedAt"],
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

        public function get_last_updated_projects(int $count) : array
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->prepare("
            SELECT p.Id, p.Title, p.Url, p.Description, p.IsVisible, MAX(pu.UpdatedAt) as UpdatedAt
            FROM Project p
            LEFT OUTER JOIN ProjectUpdate pu ON p.Id = pu.ProjectId
            WHERE p.IsVisible = 1 AND pu.UpdatedAt IS NOT NULL
            GROUP BY p.Id, p.Title, p.Url, p.Description, p.IsVisible
            ORDER BY UpdatedAt DESC
            LIMIT ?");

            $query->bindParam(1, $count, PDO::PARAM_INT);
            $query->execute();

            $projects = [];

            while($row = $query->fetch())
            {
                $project = new Project(
                    $row["Id"],
                    $row["Title"],
                    $row["Url"],
                    $row["Description"],
                    $row["UpdatedAt"],
                    $row["IsVisible"]);

                array_push($projects, $project);
            }

            return $projects;
        }
    }

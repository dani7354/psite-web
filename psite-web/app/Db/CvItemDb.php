<?php
    namespace App\Db;

    use App\Db\MySqlPdoConnector;
    use App\Model\CvItem;
    use App\Model\CvItemType;
    use PDO;
    use DateTime;

    class CvItemDb
    {
        private $db_connector;

        public function __construct()
        {
            $this->db_connector = new MySqlPdoConnector();
        }

        public function all_by_type() : array
        {
            $all_items = $this->all();
            $all_by_type = [];

            foreach ($all_items as $item)
            {
                if (!array_key_exists($item->type->value, $all_by_type))
                {
                    $all_by_type[$item->type->value] = [];
                }

                array_push($all_by_type[$item->type->value], $item);
            }

            return $all_by_type;
        }

        public function all() : array
        {
            $connection = $this->db_connector->get_connection();
            $query = $connection->query("SELECT Id, Title, Description, Type,
            DateStart, DateEnd
            FROM CvTableItem
            WHERE IsVisible = 1
            ORDER BY DateStart DESC");

            $cv_items = [];

            while($row = $query->fetch())
            {
                $is_current = $row["DateEnd"] == null;
                $cv_item = new CvItem(
                    $row["Id"],
                    $row["Title"],
                    $row["Description"],
                    new DateTime($row["DateStart"]),
                    new DateTime($row["DateEnd"]),
                    CvItemType::from($row["Type"]),
                    $is_current);

                array_push($cv_items, $cv_item);
            }

            $this->db_connector->close_connection($connection);

            return $cv_items;
        }
    } 

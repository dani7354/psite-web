<?php
    namespace App\Repository;

    use PDO;
    use App\Db\MySqlPdoConnector;
    use App\Model\Message;
    use App\Repository\Interface\MessageRepositoryInterface;
    use App\Repository\Interface\DatabaseConnectorInterface;

    class MessageRepository implements MessageRepositoryInterface
    {
        private readonly DatabaseConnectorInterface $db_connector;

        public function __construct(DatabaseConnectorInterface $db_connector)
        {
            $this->db_connector = $db_connector;
        }

        public function create(Message $message) : bool
        {
            $connection = $this->db_connector->get_connection();
            $stmt = $connection->prepare("INSERT INTO
            Message(SenderName, SenderEmail, SenderIp, Subject, Body, DateCreated)
            VALUES (?,?,?,?,?,?)");

            $sender_name = $message->sender_name;
            $sender_email = $message->sender_email;
            $sender_ip = $message->sender_ip;
            $subject = $message->subject;
            $body = $message->body;
            $date_created = date("Y/m/d H:i:s");

            $stmt->bindParam(1, $sender_name, PDO::PARAM_STR, 255);
            $stmt->bindParam(2, $sender_email, PDO::PARAM_STR, 255);
            $stmt->bindParam(3, $sender_ip, PDO::PARAM_STR, 45);
            $stmt->bindParam(4, $subject, PDO::PARAM_STR, 255);
            $stmt->bindParam(5, $body, PDO::PARAM_STR, 1200);
            $stmt->bindParam(6, $date_created, PDO::PARAM_STR);

            $stmt->execute();
            $this->db_connector->close_connection($connection);

            return true;
        }
    }

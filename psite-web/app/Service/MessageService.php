<?php
    namespace App\Service;

    use App\Db\MessageDb;
    use App\Model\Message;
    use App\Helper\Validation\InputValidator;
    use App\Helper\CaptchaHelper;

    class MessageService 
    {
        private readonly MessageDb $message_db;

        public function __construct(MessageDb $message_db)
        {
            $this->message_db = $message_db;
        }

        public static function validate(Message $message) : array
        {
            $name_max = 255;
            $name_min = 1;
            $content_max = 850;
            $content_min = 1;

            $errors = [];
            
            if (!InputValidator::has_valid_email_format($message->sender_email))
            {   
                $errors[] = "E-mailen er ikke i det tilladte format";
            }
            if (InputValidator::is_blank($message->sender_name) ||
            !InputValidator::has_length_less_than($message->sender_name, $name_max) ||
            !InputValidator::has_length_greater_than($message->sender_name, $name_min))
            {
                $errors[] = "Navnet skal indeholde mellem 2 og 255 tegn";
            }
            if (InputValidator::is_blank($message->subject) ||
            !InputValidator::has_length_less_than($message->subject, $name_max) ||
            !InputValidator::has_length_greater_than($message->subject, $name_min))
            {
                $errors[] = "Emnefelt skal indeholde mellem 2 og 255 tegn";
            }
            if (InputValidator::is_blank($message->body) ||
            !InputValidator::has_length_less_than($message->body, $content_max) ||
            !InputValidator::has_length_greater_than($message->body, $content_min))
            {
                $errors[] = "Beskeden skal indeholde mellem 2 og 850 tegn";
            }

            return $errors;
        }

        public function create(Message $message) : bool
        {
            return $this->message_db->create($message);
        }
    }
?>
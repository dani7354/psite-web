<?php
namespace App\Service;

use App\Db\MessageDb;
use App\Model\Message;
use App\Helper\Validation\InputValidator;
use App\Helper\CaptchaHelper;

class MessageService 
{
    private readonly MessageDb $message_db;

    public function __construct()
    {
        $this->message_db = new MessageDb();
    }

    public static function validate(Message $message) : array
    {
        $name_max = 255;
        $name_min = 1;
        $content_max = 850;
        $content_min = 1;

        $errors = [];
        
        if (!isset($input["captcha"]) || !CaptchaHelper::verify_captcha($input["captcha"]))
        {
            $errors[] = "CAPTCHA ikke løst korrekt";
        }
        if (!isset($input["token"]) || !CsrfHelper::verify_token($input["token"]))
        {
            $errors[] = "Ugyldig CSRF-token";
        }
        if (!InputValidator::has_valid_email_format($input["email"]))
        {
            $errors[] = "E-mailen er ikke i det tilladte format";
        }
        if (InputValidator::is_blank($input["name"]) ||
        !InputValidator::has_length_less_than($input["name"], $name_max) ||
        !InputValidator::has_length_greater_than($input["name"], $name_min))
        {
            $errors[] = "Navnet skal indeholde mellem 2 og 255 tegn";
        }
        if (InputValidator::is_blank($input["subject"]) ||
        !InputValidator::has_length_less_than($input["subject"], $name_max) ||
        !InputValidator::has_length_greater_than($input["subject"], $name_min))
        {
            $errors[] = "Emnefelt skal indeholde mellem 2 og 255 tegn";
        }
        if (InputValidator::is_blank($input["message"]) ||
        !InputValidator::has_length_less_than($input["message"], $content_max) ||
        !InputValidator::has_length_greater_than($input["message"], $content_min))
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
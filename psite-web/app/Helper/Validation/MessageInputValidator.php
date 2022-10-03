<?php
    namespace App\Helper\Validation;

    use App\Helper\Validation\InputValidator;
    use App\Helper\Security\CsrfHelper;
    use App\Helper\Security\CaptchaHelper;

    class MessageInputValidator extends InputValidator
    {
        public static function validate_input($input) : array
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
            if (!parent::has_valid_email_format($input["email"]))
            {
                $errors[] = "E-mailen er ikke i det tilladte format";
            }
            if (parent::is_blank($input["name"]) ||
            !parent::has_length_less_than($input["name"], $name_max) ||
            !parent::has_length_greater_than($input["name"], $name_min))
            {
                $errors[] = "Navnet skal indeholde mellem 2 og 255 tegn";
            }
            if (parent::is_blank($input["subject"]) ||
            !parent::has_length_less_than($input["subject"], $name_max) ||
            !parent::has_length_greater_than($input["subject"], $name_min))
            {
                $errors[] = "Emnefelt skal indeholde mellem 2 og 255 tegn";
            }
            if (parent::is_blank($input["message"]) ||
            !parent::has_length_less_than($input["message"], $content_max) ||
            !parent::has_length_greater_than($input["message"], $content_min))
            {
                $errors[] = "Beskeden skal indeholde mellem 2 og 850 tegn";
            }

            return $errors;
        }
    }

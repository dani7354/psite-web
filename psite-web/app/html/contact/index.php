<?php
    session_start();
    require_once "../../initialize.php";

    use App\Helper\Security\CsrfHelper;
    use App\Helper\Security\CaptchaHelper;
    use App\Helper\Security\ErrorHandler;
    use App\Helper\Validation\MessageInputValidator;
    use App\Db\MessageDb;
    use App\Model\Message;
    use App\Model\PageType;

    $current_page_id = PageType::Contact->value;

    $name = "";
    $email = "";
    $subject = "";
    $message = "";
    $success = false;
    $errors = [ ];

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        try
        {
            $errors = MessageInputValidator::validate_input($_POST);
            $input_valid = empty($errors);

            if ($input_valid)
            {
                $name_stripped = strip_tags($_POST["name"]);
                $subject_stripped = strip_tags($_POST["subject"]);
                $message_body_stripped = strip_tags($_POST["message"]);
                $remote_ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];

                $new_message = new Message(
                    $name_stripped,
                    $_POST["email"],
                    $remote_ip,
                    $subject_stripped,
                    $message_body_stripped);
                $db = new MessageDb();
                $success = $db->create($new_message);
            }
        }
        catch (Exception $exception)
        {
            ErrorHandler::handle_exception($exception, 500);
        }

        $name = isset($_POST["name"]) && !$success ? htmlspecialchars($_POST["name"]) : "";
        $email = isset($_POST["email"]) && !$success ? htmlspecialchars($_POST["email"]) : "";
        $subject = isset($_POST["subject"]) && !$success ? htmlspecialchars($_POST["subject"]) : "";
        $message = isset($_POST["message"]) && !$success ? htmlspecialchars($_POST["message"]) : "";
    }

    $token = CsrfHelper::create_new_token();
    $captcha_image = CaptchaHelper::get_image();
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 text-left">
            <h1><?php echo $pages[$current_page_id]; ?></h1>
            <p>
                Hvis du ønsker at kontakte mig, kan du sende en
                e-mail eller benytte kontaktformularen her på siden.
            </p>
          <ul>
              <li><a href="mailto:<?php echo EMAIL; ?>">d@stuhrs.dk</a> (<a href="/assets/files/public_key.asc">PGP public key</a>)</li>
          </ul>
            <?php if (isset($errors) && !empty($errors)) { ?>
            <span>
                <strong class="text-danger">Fejl i input:</strong>
                <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><small class="text-danger"><?php echo $error; ?></small></li>
                <?php } ?>
                </ul>
            </span>
            <?php } else if ($success) { ?>
            <span>
                <strong class="text-success">Tak for din besked!</strong>
            </span>
            <?php } ?>

            <form method="post" action="index.php">
                <div class="form-row">
                    <div class="col">
                        <input name="name" type="text" class="form-control" placeholder="Navn" value="<?php echo $name; ?>" required>
                    </div>
                </div>
                
                <p>
                <div class="form-row">
                    <div class="col">
                        <input name="email" type="email" class="form-control" placeholder="E-mail" value="<?php echo $email; ?> " required>
                    </div>
                </div>

                <p>
                <div class="form-row">
                    <div class="col">
                        <input name="subject" type="text" class="form-control" placeholder="Emne" value="<?php echo $subject; ?>" required>
                    </div>
                </div>

                <p>
                <div class="form-row">
                    <div class="col">
                        <textarea name="message" class="form-control" placeholder="Besked" required><?php echo $message; ?></textarea>
                        <input name="token" type="hidden" value="<?php echo $token; ?>" />
                    </div>
                </div>

                <p>
                <div class="form-row">
                    <div class="col">
                        <img src="<?php echo $captcha_image; ?>" alt="CAPTCHA image" />
                    </div>
                </div>

                <p>
                <div class="form-row">
                    <div class="col-6">
                        <input name="captcha" type="text" class="form-control" placeholder="CAPTCHA" value="" required>
                    </div>
                </div>

                <p>
                <div class="form-row">
                     <div class="col">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

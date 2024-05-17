<?php
    session_start();
    require_once "../../initialize.php";

    use App\Service\PageService;
    use App\Service\UrlService;
    use App\Service\CaptchaService;
    use App\Service\CsrfTokenService;
    use App\Service\MessageService;
    use App\Helper\Security\ErrorHandler;
    use App\Helper\Validation\MessageInputValidator;
    use App\Db\MessageDb;
    use App\Model\Message;
    use App\Model\PageType;
    use App\Shared\SiteInfo;
    use App\Shared\DatabaseInfo;

    $current_page_id = PageType::Contact->value;

    $page_service = new PageService();

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
            $errors = [];
            if (!CsrfTokenService::verify_token($_POST["token"]))
            {
                $errors[] = "Ugyldig CSRF-token";
            }
            if (!CaptchaService::verify_captcha($_POST["captcha"]))
            {
                $errors[] = "Ugyldig CAPTCHA";
            }

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

            $message_service = new MessageService(
                new MessageDb(
                    DatabaseInfo::get_host(),
                    DatabaseInfo::get_port(),
                    DatabaseInfo::get_name(),
                    DatabaseInfo::get_user(),
                    DatabaseInfo::get_password()));

            $message_errors = $message_service->validate($new_message);
            $errors = array_merge($errors, $message_errors);
            if (empty($errors))
            {
                $success = $message_service->create($new_message);
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

    $token = CsrfTokenService::create_new_token();
    $captcha_image = CaptchaService::get_image();
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12 text-left">
            <h1><?php echo $page_service->get_page_title(PageType::Contact); ?></h1>
            <p>
                Hvis du ønsker at kontakte mig, kan du sende en
                e-mail eller benytte kontaktformularen her på siden.
            </p>
          <ul>
              <li><a class="link-secondary" href="mailto:<?php echo SiteInfo::EMAIL; ?>"><?php echo SiteInfo::EMAIL; ?></a> (<a class="link-secondary" href="<?php echo "//keys.openpgp.org/search?q=" . SiteInfo::EMAIL; ?>">PGP public key</a>)</li>
          </ul>
            <?php if (!empty($errors)) { ?>
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

            <form method="post" action="/contact/index.php">
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

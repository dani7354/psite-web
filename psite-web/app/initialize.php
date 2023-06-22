<?php
    # Constants for files and directories
    $public_end = strpos($_SERVER["SCRIPT_NAME"], "/html");
    $doc_root = substr($_SERVER["SCRIPT_NAME"], 0, $public_end);

    define("APP_ROOT_PATH", dirname(__FILE__));
    define("WWW_ROOT", $doc_root);
    const VENDOR_PATH = APP_ROOT_PATH . "/vendor";
    const HTML_ELEMENTS_PATH = APP_ROOT_PATH . "/View";
    const ASSET_PATH = WWW_ROOT . "/assets";
    const CSS_PATH = ASSET_PATH . "/css";
    const IMG_PATH = ASSET_PATH . "/img";
    const JS_PATH = ASSET_PATH . "/js";

    # Requires and includes for all pages
    require_once(VENDOR_PATH . "/autoload.php");

    use App\Model\PageType;

    # Site information
    const SITE_NAME = "Stuhrs.dk";
    const DOMAIN = "www.stuhrs.dk";
    const FULL_NAME = "Daniel Stuhr Petersen";
    const EMAIL = "d@stuhrs.dk";

    # Page titles
    $pages = [
        PageType::Home->value => "Forside",
        PageType::Project->value => "Projekter",
        PageType::Contact->value => "Kontakt"
    ];

    # Database information
    define("DB_HOST", getenv("DB_HOST"));
    define("DB_PORT", 3306);
    define("DB_NAME", getenv("DB_NAME"));
    define("DB_USER", getenv("DB_USER"));
    define("DB_PASSWORD", getenv("DB_PASSWORD"));

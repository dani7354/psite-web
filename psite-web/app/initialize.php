<?php
    # Constants for files and directories
    $public_end = strpos($_SERVER["SCRIPT_NAME"], "/html");
    $doc_root = substr($_SERVER["SCRIPT_NAME"], 0, $public_end);

    define("PROJECT_ROOT", dirname(dirname(__FILE__)));
    define("APP_ROOT_PATH", dirname(__FILE__));
    define("WWW_ROOT", $doc_root);
    const VENDOR_PATH = PROJECT_ROOT . "/vendor";
    const HTML_ELEMENTS_PATH = APP_ROOT_PATH . "/View";

    # Requires and includes for all pages
    require_once(VENDOR_PATH . "/autoload.php");

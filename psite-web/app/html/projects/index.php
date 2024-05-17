<?php
    require_once "../../initialize.php";

    use App\Helper\Security\ErrorHandler;
    use App\Service\UrlService;
    use App\Service\ProjectService;
    use App\Service\PageService;
    use App\Db\ProjectDb;
    use App\Model\Project\Project;
    use App\Model\PageType;
    use App\Shared\DatabaseInfo;

    $page_service = new PageService();
    $url_service = new UrlService();

    $current_page_id = PageType::Project->value;

    try
    {
        $project_db = new ProjectDb(
            DatabaseInfo::get_host(),
            DatabaseInfo::get_port(),
            DatabaseInfo::get_name(),
            DatabaseInfo::get_user(),
            DatabaseInfo::get_password());

        $project_service = new ProjectService($project_db);
        $projects = $project_db->all();
    }
    catch (Exception $exception)
    {
        ErrorHandler::handle_exception($exception, 500);
    }
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col text-left">
            <h1><?php echo $page_service->get_page_title(PageType::Project); ?></h1>
            <p>
                Herunder finder du et lille udvalg af mine programmeringsprojekter.
            </p>
            <div id="project-container" class="row row-cols-1 row-cols-md-3 g-3"></div>
            <button id="next-button" type="button" class="btn btn-primary">Vis flere</button>
            <script src="<?php echo $url_service->get_js_url("projects.js"); ?>"
            integrity="<?php $url_service->get_integrity_attribute("projects.js"); ?>"></script>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

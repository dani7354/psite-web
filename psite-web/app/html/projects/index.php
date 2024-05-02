<?php
    require_once "../../initialize.php";

    use App\Helper\Security\ErrorHandler;
    use App\Db\ProjectDb;
    use App\Model\Project\Project;
    use App\Model\PageType;

    $current_page_id = PageType::Project->value;
    $project_images_path = IMG_PATH . "/projects";

    try
    {
        $project_db = new ProjectDb();
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
            <h1><?php echo $pages[$current_page_id]; ?></h1>
            <p>
                Herunder finder du et lille udvalg af mine programmeringsprojekter.
            </p>
            <div id="project-container" class="row row-cols-1 row-cols-md-3 g-3"></div>
            <button id="next-button" type="button" class="btn btn-primary">Vis flere</button>
            <script src="<?php echo JS_PATH . "/projects.js"; ?>"></script>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

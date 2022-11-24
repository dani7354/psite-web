<?php
    require_once("../../initialize.php");

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

<?php include(HTML_ELEMENTS_PATH . "/header.php"); ?>

<div class="container mt-4">
    <div class="col text-left">
        <h1><?php echo $pages[2]; ?></h1>
        <p>
            Herunder finder du korte beskrivelser og links til nogle af mine projekter.
        </p>

        <div id="project-container" class="row row-cols-1 row-cols-md-2">
         
        </div>
        <button id="next-button" type="button" class="btn btn-primary btn-lg btn-block">Vis flere</button>
    </div>
</div>

<?php include(HTML_ELEMENTS_PATH . "/footer.php"); ?>

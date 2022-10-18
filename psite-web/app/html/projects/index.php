<?php
    require_once("../../initialize.php");

    use App\Helper\Security\ErrorHandler;
    use App\Db\ProjectDb;
    use App\Model\Project;
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

<div class="col text-left mt-4">
    <h1><?php echo $pages[2]; ?></h1>
    <p>
        Herunder finder du korte beskrivelser og links til nogle af mine projekter.
    </p>

    <div class="row row-cols-1 row-cols-md-2">
        <?php foreach ($projects as $project) { ?>
            <div class="col mb-4 d-flex align-items-stretch">
                <div class="card">
                    <div class="card-body">
                        <?php
                            $web_image_path = "{$project_images_path}/" . htmlspecialchars($project->image);
                            $full_image_path = "{$_SERVER['DOCUMENT_ROOT']}{$web_image_path}";

                            if (file_exists($full_image_path)) { ?>
                                <img class="card-img-top"
                                    src="<?php echo $web_image_path; ?>"
                                    alt="<?php echo htmlspecialchars($project->title); ?>">
                        <?php } ?>

                        <h5 class="card-title"><?php echo htmlspecialchars($project->title); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($project->description); ?></p>
                        <a href="<?php echo htmlspecialchars($project->url); ?>" class="btn btn-primary">Se mere</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include(HTML_ELEMENTS_PATH . "/footer.php"); ?>

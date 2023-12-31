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
                Nogle er lavet i forbindelse med mit studie, andre har jeg rodet med i fritiden.
                De fleste af dem er skrevet i Python, som jeg er ret glad for, men der er også et
                par stykker, der er skrevet i andre sprog, f.eks. C#, PowerShell og PHP.
            </p>
            <div id="project-container" class="row row-cols-1 row-cols-md-2"></div>
            <button id="next-button" type="button" class="btn btn-primary">Vis flere</button>
            <script src="<?php echo JS_PATH . "/projects.js"; ?>"
            integrity="sha256-xOzdO/8gDtKM8uHqFnHM2d9STxY9iH1tm/VMs6R2+Eg=
            sha384-6gcuipvccuUFcfYkIjvAJZ0UFifjNk4i++X4PpAw7TeeSjDVnC/B0MH7sfekfR8M
            sha512-9fo2r1Cc0f4aPCqAXo+6rnoztZhQiy/d1tfDEC0atuHd2Itq1fyO2AhJrC8iGMDpzqna6wPjPoxEQ6EMkdK7Ew=="></script>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

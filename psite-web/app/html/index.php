<?php
    require_once "../initialize.php";

    use App\Model\PageType;
    use App\Shared\DatabaseInfo;
    use App\Model\Project\Project;
    use App\Db\ProjectDb;
    use App\Service\ProjectService;
    use App\Service\PageService;

    $current_page_id = PageType::Home->value;

    $page_service = new PageService();
    $project_service = new ProjectService(
        new ProjectDb(
            DatabaseInfo::get_host(), 
            DatabaseInfo::get_port(), 
            DatabaseInfo::get_name(),
            DatabaseInfo::get_user(), 
            DatabaseInfo::get_password()));

    $latest_updated_projects = $project_service->get_last_updated_projects(5);
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md text-left">
            <h1>
                <?php echo $page_service->get_page_title(PageType::Home); ?>
            </h1>
            <p>
                Velkommen til min hjemmeside!
            </p>
            <p>
                Dette er min personlige side, hvor du kan følge med i, hvad jeg går og laver.
                Eftersom jeg arbejder med it og programmering, handler siden mest om softwareprojekter. 
                Du finder desuden mine <a class="link-secondary" href="/contact">kontaktinformationer</a> og mit <a class="link-secondary" href="/about">cv</a>. 
            </p>
        </div>
        <div class="col-sm mt-4 float-right card bg-light mb-3">
            <h3>Seneste arbejde</h3>
            <ul>
            <?php foreach($latest_updated_projects as $project) { ?>
                <?php
                    $title = htmlspecialchars($project->title);
                    $updated_at = htmlspecialchars($project->updated_at);
                    $url = htmlspecialchars($project->url);
                ?>
                <li>
                    <?php echo "$title ($updated_at)"; ?> <a href="<?php echo $url; ?>">
                        <i class="fa fa-github fa-lg fa-github-frontpage"></i>
                    </a>
                </li>
            <?php } ?>
            </ul>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

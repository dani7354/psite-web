<?php
    require_once "../initialize.php";

    use App\DiContainer;
    use App\Service\Interface\PageServiceInterface;
    use App\Service\Interface\UrlServiceInterface;
    use App\Model\PageType;

    $page_service = DiContainer::get(PageServiceInterface::class);
    $url_service = DiContainer::get(UrlServiceInterface::class);

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
            <button id="next-button" type="button" class="btn btn-outline-primary">Vis flere</button>
            <script src="<?php echo $url_service->get_js_url("projects.js"); ?>"
            integrity="<?php echo $url_service->get_integrity_attribute("project.js"); ?>"></script>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

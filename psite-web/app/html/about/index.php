<?php
  require_once "../../initialize.php";

  use App\DiContainer;
  use App\Model\PageType;
  use App\Service\Interface\PageServiceInterface;
  use App\Service\Interface\UrlServiceInterface;

  $url_service = DiContainer::get(UrlServiceInterface::class);
  $page_service = DiContainer::get(PageServiceInterface::class);
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <h1>
        <?php echo $page_service->get_page_title(PageType::About); ?>
    </h1>
    <div class="row">
        <div class="col-sm-12 text-left">
            <p><strong>Daniel Stuhr Petersen</strong></p>
            <p>
                <strong>Uddannelse</strong>
                Master i it, softwarekonstruktion, Aalborg Universitet, 2025-
                <br>
                Professionsbachelor i it-sikkerhed, Københavns Erhvervsakademi, 2020-2021
                <br>
                Datamatiker, UCL Erhvervsakademi og Professionshøjskole, 2017-2020
            </p>
            <p>
                <strong>Beskæftigelse</strong>
                <br>
                Softwareudvikler, Forsvaret, 2023-
                <br>
                Softwareudvikler, Hesehus A/S, 2021-2023
                <br>
                Studenterprogrammør, ABB A/S, 2020-2021
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

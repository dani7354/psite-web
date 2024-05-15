<?php 
  require_once "../../initialize.php"; 

  use App\Model\PageType;
  use App\Service\PageService;
  use App\Service\UrlService;

  $page_service = new PageService();
  $url_service = new UrlService();

  $current_page_id = PageType::About->value;
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <h1>
        <?php echo $page_service->get_page_title(PageType::About); ?>
    </h1>
    <div class="row">
        <div class="col-sm-8 text-left">
            <p><strong>Daniel Stuhr Petersen</strong></p>
            <p>
                <strong>Uddannelse</strong> 
                <br>
                Professionsbachelor i it-sikkerhed, Københavns Erhvervsakademi, 2020-2021
                <br>
                Datamatiker, UCL Erhvervsakademi og Professionshøjskole, 2017-2020
            </p>
            <p>
                <strong>Beskæftigelse</strong>
                <br>
                It-medarbejder, Forsvaret, 2023-
                <br>
                Softwareudvikler, Hesehus A/S, 2021-2023
                <br>
                Studenterprogrammør, ABB A/S, 2020-2021
        </div>
        <div class="col-sm-4">
            <img class="img-fluid rounded float-right" src="<?php echo $url_service->get_img_url("daniel_stuhr_petersen.JPG"); ?>" alt="Daniel Stuhr Petersen">
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>
<?php
  require_once "../../../initialize.php";

  use App\DiContainer;
  use App\Model\PageType;
  use App\Service\Interface\PageServiceInterface;
  use App\Service\Interface\UrlServiceInterface;

  $url_service = DiContainer::get(App\Service\Interface\UrlServiceInterface::class);
  $page_service = DiContainer::get(App\Service\Interface\PageServiceInterface::class);
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <h1>
        Not Found
    </h1>
    <div class="row">
        <div class="col-sm-12 text-left">
            <p>
                Siden blev ikke fundet.
            </p>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

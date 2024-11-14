<?php
    use App\DiContainer;
    use App\Service\Interface\PageServiceInterface;
    use App\Service\Interface\UrlServiceInterface;
    use App\Model\PageType;
    use App\Helper\Security\ErrorHandler;
    use App\Shared\SiteInfo;

    $page_service = DiContainer::get(PageServiceInterface::class);
    $url_service = DiContainer::get(UrlServiceInterface::class);

    $current_page_id = $page_service->get_page_type_for_current($_SERVER["REQUEST_URI"]);
?>
<!DOCTYPE html>
<html lang="da" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $url_service->get_css_url("bootstrap.css"); ?>">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="<?php echo $url_service->get_css_url("font-awesome.css"); ?>">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $url_service->get_css_url("style.css"); ?>">
    <link rel="stylesheet" href="<?php echo $url_service->get_css_url("bootstrap_custom.css"); ?>">
    <title><?php echo $page_service->get_page_title($current_page_id) . " - " . SiteInfo::SITE_NAME; ?> </title>
  </head>
  <body class="d-flex flex-column h-100">
    <script src="<?php echo $url_service->get_js_url("jquery.min.js"); ?>"
      integrity="<?php echo $url_service->get_integrity_attribute("jquery.min.js"); ?>"></script>
    <script src="<?php echo $url_service->get_js_url("bootstrap.bundle.js"); ?>"
      integrity="<?php echo $url_service->get_integrity_attribute("bootstrap.bundle.js"); ?>"></script>
      <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
        <a class="navbar-brand col-lg-3" href="/"><?php echo SiteInfo::SITE_NAME; ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Home){ echo "active"; }?>" href="/"><?php echo $page_service->get_page_title(PageType::Home); ?> </a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Project){ echo "active"; }?>" href="/projects"><?php echo $page_service->get_page_title(PageType::Project); ?></a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::About){ echo "active"; }?>" href="/about"><?php echo $page_service->get_page_title(PageType::About); ?></a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Contact){ echo "active"; }?>" href="/contact"><?php echo $page_service->get_page_title(PageType::Contact); ?></a>
            </ul>
          </div>
        </div>
        </nav>
      </header>
      <main>

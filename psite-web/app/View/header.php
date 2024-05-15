<?php
    use App\Model\PageType;
    use App\Helper\Security\ErrorHandler;
    use App\Service\PageService;
    use App\Service\UrlService;
    use App\Shared\SiteInfo;


    $page_service = new PageService();
    $url_service = new UrlService();

    if (!isset($current_page_id))
    {
        $current_page_id = PageType::Home->value;
    }
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
    <title><?php echo $page_service->get_page_title(PageType::Home) . " - " . SiteInfo::SITE_NAME; ?> </title>
  </head>
  <body class="d-flex flex-column h-100">
    <script src="<?php echo JS_PATH . "/jquery.min.js"; ?>"
      integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=
      sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs
      sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="></script>
    <script src="<?php echo JS_PATH . "/bootstrap.bundle.js"; ?>"
      integrity="sha256-nXxM3vVk1ByhwczQW2ZCRZedoIL4U5PuQKMoprvQKzE= 
      sha384-6yr0NH5/NO/eJn8MXILS94sAfqCcf2wpWTTxRwskNor6dIjwbYjw1/PZpr654rQ5
      sha512-GTHq28lFyjvEmJ5HcqINJlsDRfYe7v0v6Ru7X8FyOUSngYz+KJs6v3iMiMxGN1z07sbd3zKH0H4WZ3sZMHUPHw=="></script>
      <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="">
        <div class="container">
        <a class="navbar-brand" href="/"><?php echo SiteInfo::SITE_NAME; ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Home->value){ echo "active"; }?>" href="/"><?php echo $page_service->get_page_title(PageType::Home); ?> </a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Project->value){ echo "active"; }?>" href="/projects"><?php echo $page_service->get_page_title(PageType::Project); ?></a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::About->value){ echo "active"; }?>" href="/about"><?php echo $page_service->get_page_title(PageType::About); ?></a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Contact->value){ echo "active"; }?>" href="/contact"><?php echo $page_service->get_page_title(PageType::Contact); ?></a>
            </ul>
          </div>
        </div>
        </nav>
      </header>
      <main>
  
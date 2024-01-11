<?php
    use App\Model\PageType;
?>
<!DOCTYPE html>
<html lang="da">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH . "/bootstrap.css"; ?>">
    <title><?php echo isset($page_id) && isset($pages[$page_id]) ? $pages[$page_id] . " - " . SITE_NAME : SITE_NAME; ?> </title>
  </head>
  <body>
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
        <a class="navbar-brand" href="/"><?php echo FULL_NAME; ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Home->value){ echo "active"; }?>" href="/"><?php echo $pages[PageType::Home->value]; ?> </a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Project->value){ echo "active"; }?>" href="/projects"><?php echo $pages[PageType::Project->value]; ?></a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::About->value){ echo "active"; }?>" href="/about"><?php echo $pages[PageType::About->value]; ?></a>
                <a class="nav-item nav-link <?php if ($current_page_id === PageType::Contact->value){ echo "active"; }?>" href="/contact"><?php echo $pages[PageType::Contact->value]; ?></a>
            </ul>
          </div>
        </div>
        </nav>
      </header>
    <div class="container">
  
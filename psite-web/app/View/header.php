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
    <link rel="stylesheet" href="<?php echo CSS_PATH . "/bootstrap.min.css"; ?>" >
    <title><?php echo isset($page_id) && isset($pages[$page_id]) ? $pages[$page_id] . " - " . SITE_NAME : SITE_NAME; ?> </title>
  </head>
  <body>
    <div class="container" >
      <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/"><?php echo FULL_NAME; ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link <?php if($current_page_id === PageType::Home->value){ echo "active"; }?>" href="/"><?php echo $pages[PageType::Home->value]; ?> </a>
                <a class="nav-item nav-link <?php if($current_page_id === PageType::Cv->value){ echo "active"; }?>" href="/cv"><?php echo $pages[PageType::Cv->value]; ?></a>
                <a class="nav-item nav-link <?php if($current_page_id === PageType::Project->value){ echo "active"; }?>" href="/projects"><?php echo $pages[PageType::Project->value]; ?></a>
                <a class="nav-item nav-link <?php if($current_page_id === PageType::Contact->value){ echo "active"; }?>" href="/contact"><?php echo $pages[PageType::Contact->value]; ?></a>
            </div>
          </div>
        </nav>
      </header>

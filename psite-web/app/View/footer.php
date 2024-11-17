<?php
  use App\Service\UrlService;
  use App\Shared\SiteInfo;
?>
<br/>
</main>
    <footer class="footer mt-auto py-3">
      <div class="container">
        <div class="d-flex align-items-center">
          <div class="p2 flex-grow-1">
            <span class="">
              &copy; <?php echo date('Y') . " " . SiteInfo::FULL_NAME; ?>
            </span>
          </div>
          <div class="p2">
            <ul class="nav list-unstyled">
              <li>
                <a href="<?php echo SiteInfo::FACEBOOK; ?>">
                  <i class="fa fa-facebook"></i>
                </a>
              </li>
              <li>
                <a href="<?php echo SiteInfo::LINKEDIN; ?> ">
                  <i class="fa fa-linkedin"></i>
                </a>
              </li>
              <li>
                <a href="<?php echo SiteInfo::GITHUB; ?>">
                  <i class="fa fa-github fa-github-profile"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
    </footer>
  </body>
</html>

<?php
    use App\Model\PageType;
?>
<br/>
<footer class="container-fluid text-center">

        <small class="align-text-bottom">&copy <?php echo date('Y') . " " . FULL_NAME; ?> </small>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Bootstrap JS -->
    <script src="<?php echo JS_PATH . "/jquery-3.6.1.min.js"; ?>"></script>
    <script src="<?php echo JS_PATH . "/bootstrap.min.js"; ?>"></script>

    <?php if ($current_page_id === PageType::Project->value) { ?>
      <!-- JavaScript for projects page -->
      <script src="<?php echo JS_PATH . "/projects.js"; ?>"></script>
    <?php } ?>
</div>
  </body>
</html>

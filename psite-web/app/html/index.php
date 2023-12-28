<?php
    require_once "../initialize.php";

    use App\Model\PageType;

    $current_page_id = PageType::Home->value;
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md text-left">
            <h1>
                <?php echo $pages[$current_page_id]; ?>
            </h1>
            <p>
                Velkommen til min hjemmeside!
            </p>
            <p>
                Mit navn er Daniel. Jeg er 26 år gammel, bor i København og arbejder med it.
            </p>
       
        </div>
        <div class="col-sm mt-4 float-right card bg-light mb-3">
            <!-- TODO: replace projects -->
            <h3>Seneste projekter</h3>
            <ul>
                <li><a href="#">book-prices (2023-12-25)</a></li>
                <li><a href="#">ssh-hosts (2023-12-10)</a></li>
                <li><a href="#">samba-fucker (2023-12-09)</a></li>
                <li><a href="#">hash-cracker (2023-12-01)</a></li>
            </ul>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

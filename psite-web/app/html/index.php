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
                Dette er min personlige side, hvor du kan følge med i, hvad jeg går og laver.
                Eftersom jeg arbejder med it og programmering, handler siden mest om softwareprojekter. 
                Du finder desuden mine <a href="/contact">kontaktinformationer</a> og mit <a href="/about">cv</a>. 
            </p>
       
        </div>
        <div class="col-sm mt-4 float-right card bg-light mb-3">
            <!-- TODO: replace projects -->
            <h3>Seneste projekter (under ombygning)</h3>
            <ul>
                <li><a href="#">projekt-1 (2023-12-25)</a></li>
            </ul>
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

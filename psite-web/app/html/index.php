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
            <p>
                Hjemmesiden blev oprettet i forbindelse med et projekt på datamatikerstudiet tilbage i 2019. Dengang fungerede den som en blog og portfolio, som jeg brugte til at dokumentere mit projektarbejde. Den har derefter været nede ad flere omgange, men i 2021 satte jeg mig for at renovere den en smule og lægge den online igen. Nu forsøger jeg at holde oplysningerne på siden opdaterede og at tilføje lidt nyt indhold, når jeg en gang imellem har tid. :-)
            </p>
        </div>
        <div class="col-sm mt-4">
            <img class="img-fluid rounded float-right" src="<?php echo IMG_PATH . "/code.jpg"; ?>" alt="bare lidt Python" />
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>

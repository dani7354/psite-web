<?php
    require_once("../../initialize.php");

    use App\Helper\Security\ErrorHandler;
    use App\View\CvTable;
    use App\Db\CvItemDb;
    use App\Model\CvItem;
    use App\Model\CvItemType;
    use App\Model\PageType;

    $current_page_id = PageType::Cv->value;

    try
    {
        $db = new CvItemDb();
        $cv_items_by_type = $db->all_by_type();

        $table = new CvTable($cv_items_by_type[CvItemType::WorkExperience->value], "Erhvervserfaring");
        $exp_table_html = $table->getHtml();

        $table = new CvTable($cv_items_by_type[CvItemType::Education->value], "Uddannelse");
        $edu_table_html = $table->getHtml();
    }
    catch (Exception $exception)
    {
        ErrorHandler::handle_exception($exception, 500);
    }
?>

<?php include(HTML_ELEMENTS_PATH . "/header.php"); ?>

<div class="container text-left mt-4">
    <div class="row">
        <div class="col-lg-8 text-left">
            <h1>
                <?php echo $pages[$current_page_id]; ?>
            </h1>
            <div class="mt-4">
                <h3>
                    Kort om mig
                </h3>
                <p>
                    Jeg er 25 år gammel og kommer oprindeligt fra Sønderjylland, men bor pt. i Odense, hvor jeg arbejder som
                    softwareudvikler. Jeg er uddannet inden for IT og interesserer mig meget for programmering og
                    it-sikkerhed. Ved siden af mit arbejde kan jeg godt lide at løbe, læse bøger samt bruge
                    tid med familie og venner.
                </p>
            </div>

            <?php
                echo $exp_table_html;
                echo $edu_table_html;
            ?>
        </div>

        <div class="col-sm-4">
            <img class="img-fluid rounded float-right" src="<?php echo IMG_PATH . "/daniel_stuhr.png"; ?>" alt="Daniel Stuhr Petersen" />
            <a href="mailto:d@stuhrs.dk">
                <img class="img-fluid img-thumbnail" src="<?php echo IMG_PATH . "/envelope-fill.svg"; ?>" height="32" width="32"  alt="Min e-mail" />
            </a>
            <a href="tel:+4527193930">
                <img class="img-fluid img-thumbnail" src="<?php echo IMG_PATH . "/telephone-fill.svg"; ?>" height="32" width="32" alt="Telefon" />
            </a>

            <a href="//www.linkedin.com/in/daniel-stuhr-petersen-8aa70414a">
            <img class="img-fluid img-thumbnail" src="<?php echo IMG_PATH . "/linkedin.svg" ?>" height="32" width="32" alt="Min LinkedIn-profil" />
            </a>
            <a href="//github.com/dani7354">
                <img class="img-fluid img-thumbnail" src="<?php echo IMG_PATH . "/github.svg" ?>" height="32" width="32" alt="Min GitHub-profil" />
            </a>
        </div>
    </div>
</div>

<?php include(HTML_ELEMENTS_PATH . "/footer.php"); ?>

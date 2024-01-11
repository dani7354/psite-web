<?php 
  require_once "../../initialize.php"; 

  use App\Model\PageType;
  $current_page_id = PageType::About->value;
?>

<?php include_once HTML_ELEMENTS_PATH . "/header.php"; ?>

<div class="container mt-4">
    <h1>
        <?php echo $pages[$current_page_id]; ?>
    </h1>
    <div class="row">
        <div class="col-sm-8 text-left">
           
            <p>
                <strong>Daniel Stuhr Petersen</strong>
                <br>
                Jeg er en mand på 26 år, der bor i København og arbejder med it. I 2017 flyttede jeg til Fyn for at læse datamatiker på UCL
                og senere it-sikkerhed på KEA, mens jeg arbejdede som softwareudvikler hos ABB A/S, hvor jeg primært brugte 
                Microsoft-teknologier som .NET og MS SQL. Da jeg blev færdiguddannet i 2021, fik jeg job som .NET-udvikler hos Hesehus A/S 
                i Odense. Her udviklede jeg webshops for forskellige kunder i lige knap to år, hvorefter jeg flyttede til København for at 
                arbejde med it i Forsvaret.
            </p>   
            <p>
                Mine interesser ligger inden for softwareudvikling og it-sikkerhed, især web- og systemsikkerhed. 
                For eksempel kan jeg godt lide at udvikle applikationer og systemer for dernæst at scanne og teste 
                dem for sårbarheder. Til dette benytter jeg værktøjer såsom Nmap og Burp Suite. Jeg holder også meget
                af at automatisere repetitive opgaver som håndtering af backups, opdatering og installation af software
                samt læsning af logfiler. Her er Python et af mine foretrukne programmeringssprog.  
            </p>
            <p>
                Når jeg ikke sidder foran computeren, hvilket jeg naturligvis ikke altid gør, kan jeg godt lide at løbe en tur i skoven, læse en god bog
                og bruge tid sammen med venner og familie. 
            </p>
            <p>
                <strong>Uddannelse</strong> 
                <br>
                Professionsbachelor i it-sikkerhed, Københavns Erhvervsakademi, 2020-2021
                <br>
                Datamatiker, UCL Erhvervsakademi og Professionshøjskole, 2017-2020
            </p>
            <p>
                <strong>Beskæftigelse</strong>
                <br>
                It-medarbejder, Forsvaret, 2023-
                <br>
                Softwareudvikler, Hesehus A/S, 2021-2023
                <br>
                Studenterprogrammør, ABB A/S, 2020-2021
        </div>
        <div class="col-sm-4">
            <img class="img-fluid rounded float-right" src="/assets/img/daniel_stuhr_petersen.png" alt="Daniel Stuhr Petersen">
        </div>
    </div>
</div>

<?php include_once HTML_ELEMENTS_PATH . "/footer.php"; ?>
  
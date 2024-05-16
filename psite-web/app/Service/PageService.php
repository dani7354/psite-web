<?php 
    namespace App\Service;

    use App\Model\PageType;

    class PageService 
    {
        private readonly array $pages;

        public function __construct() 
        {
            $this->pages = [
                PageType::Home->value => "Forside",
                PageType::Project->value => "Projekter",
                PageType::Contact->value => "Kontakt",
                PageType::About->value => "Om"
            ];
        }

        public function get_page_title(PageType $page_type) : string 
        {
            return $this->pages[$page_type->value];
        }
    }
?>
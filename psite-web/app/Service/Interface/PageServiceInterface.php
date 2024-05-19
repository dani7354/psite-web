<?php
    namespace App\Service\Interface;

    use App\Model\PageType;

    interface PageServiceInterface
    {
        public function get_page_title(PageType $page_type) : string;
    }

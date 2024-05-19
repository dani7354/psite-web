<?php
    namespace App\Service\Interface;

    interface PageServiceInterface
    {
        public function get_page_title(PageType $page_type) : string;
    }

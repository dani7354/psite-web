<?php
    namespace App\Service\Interface;

    use App\Model\PageType;

    interface PageServiceInterface
    {
        public function get_page_title(PageType $page_type) : string;
        public function get_page_title_for_nav(PageType $page_type) : string;
        public function get_page_type_for_current(string $request_uri) : PageType;
    }

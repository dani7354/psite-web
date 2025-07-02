<?php
    namespace App\Service;

    use App\Service\Interface\PageServiceInterface;
    use App\Model\PageType;

    class PageService implements PageServiceInterface
    {
        private readonly array $pages;

        public function __construct()
        {
            $this->pages = [
                PageType::Project->value => "Projekter",
                PageType::Contact->value => "Kontakt",
                PageType::About->value => "Om",
                PageType::Error->value => "Error"
            ];
        }

        public function get_page_title(PageType $page_type) : string
        {
            return $this->pages[$page_type->value];
        }

        public function get_page_title_for_nav(PageType $page_type) : string
        {
            return strtoupper($this->pages[$page_type->value]);
        }

        public function get_page_type_for_current(string $request_uri) : PageType
        {
            $page_type = PageType::Error;
            if (str_starts_with($request_uri, "/contact") !== false)
            {
                $page_type = PageType::Contact;
            }
            elseif (str_starts_with($request_uri, "/about") !== false)
            {
                $page_type = PageType::About;
            }
            elseif (str_starts_with($request_uri, "/index.php") || $request_uri === "/")
            {
                $page_type = PageType::Project;
            }

            return $page_type;
        }
    }

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
                PageType::Project->value => "PROJEKTER",
                PageType::Contact->value => "KONTAKT",
                PageType::About->value => "OM"
            ];
        }

        public function get_page_title(PageType $page_type) : string
        {
            return $this->pages[$page_type->value];
        }

        public function get_page_type_for_current(string $request_uri) : PageType
        {
            $page_type = PageType::Project;
            if (str_starts_with($request_uri, "/contact") !== false)
            {
                $page_type = PageType::Contact;
            }
            elseif (str_starts_with($request_uri, "/about") !== false)
            {
                $page_type = PageType::About;
            }

            return $page_type;
        }
    }

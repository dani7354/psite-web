<?php
    use PHPUnit\Framework\TestCase;
    use PHPUnit\Framework\Attributes\DataProvider;
    use App\Service\PageService;
    use App\Model\PageType;

    final class PageServiceGetPageTypeForCurrentTest extends TestCase
    {
        public static function inputData() : array
        {
            return [
                ["/", PageType::Project],
                ["asdasd1234", PageType::Error], // Error is default
                ["/contact", PageType::Contact],
                ["/contact/about", PageType::Contact],
                ["/about", PageType::About],
                ["/about/project", PageType::About],
            ];
        }

        #[DataProvider("inputData")]
        public function testGetPageTypeForCurrent($request_uri, $result) : void
        {
            $page_service = new PageService();
            $page_type = $page_service->get_page_type_for_current($request_uri);
            $this->assertSame($result, $page_type);
        }
    }

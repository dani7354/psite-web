<?php
    namespace App\View;

    use App\Models\CvItem;

    class CvTable
    {
        const DATE_FORMAT = "Y";

        public function __construct(
            public readonly array $cv_items, 
            public readonly string $title) { }

        public function getHtml() : string
        {
            $html = "<h3>" . $this->title . "</h3>";
            $html .= $this->createTable();

            return $html;
        }

        private function createTable() : string
        {
            $html = "<table class=\"table\" border=\"0\">";
            $html .= "<tbody>";
            $html .=  $this->createTableElements();
            $html .= "</tbody>";
            $html .= "</table>";

            return $html;
        }

        private function createTableElements() : string
        {
            $html = "";
            foreach ($this->cv_items as $item)
            {
                $html .= "<tr>";
                $html .= "<td class=\"col-2\">" . $item->start->format(self::DATE_FORMAT); 
                $html .= " til " . ($item->is_current ? "nu" : $item->end->format(self::DATE_FORMAT)) . "</td>";
                $html .= "<td class=\"col-9\"><strong>" . htmlspecialchars($item->title) . "</strong>";
                $html .= isset($item->description) ? "<br>" . htmlspecialchars($item->description) : "";
                $html .= "</td></tr>";
            }

            return $html;
        }
    }

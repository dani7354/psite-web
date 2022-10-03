<?php
    namespace App\Model;

    use App\Model\CvItemType;
    use DateTime;

    class CvItem
    {
        public function __construct(
            public readonly int $id,
            public readonly string $title,
            public readonly string $description,
            public readonly DateTime $start,
            public readonly DateTime $end,
            public readonly CvItemType $type,
            public readonly bool $is_current) { }
    }

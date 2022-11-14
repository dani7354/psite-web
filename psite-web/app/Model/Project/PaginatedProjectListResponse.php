<?php ´
  namespace App\Model\Project;

  class PaginatedProjectListResponse
  {
    public function __construct(
        public readonly array $projects,
        public readonly int $projct_count,
        public readonly int $current_page_number,
        public readonly ?int $next_page_number,
        public readonly ?int $previous_page_number) { }
  }
 ?>

<?php
  namespace App\Model\Project;

  use JsonSerializable;

  class PaginatedProjectListResponse implements JsonSerializable
  {
    public function __construct(
        public readonly array $projects,
        public readonly int $project_count,
        public readonly int $current_page_number,
        public readonly ?int $next_page_number,
        public readonly ?int $previous_page_number) { }

     public function jsonSerialize() : array
     {
        $json_data["projects"] = $this->projects;
        $json_data["project_count"] = $this->project_count;
        $json_data["current_page_number"] = $this->current_page_number;
        $json_data["next_page_number"] = $this->next_page_number;
        $json_data["previous_page_number"] = $this->previous_page_number;

        return $json_data;
      }
  }

<?php
namespace App\Mapping;

use App\Model\Project\Project;
use App\Model\Project\ProjectResponse;
use App\Model\Project\PaginatedProjectListResponse;

class ProjectMapper
{
  public static function map_list(
      array $projects,
      int $project_count,
      int $page_number,
      int $projects_per_page) : PaginatedProjectListResponse
  {
    $project_responses = [];

    foreach ($projects as $project)
    {
      $project_response = self::map_item($project);
      array_push($project_responses, $project_response);
    }

    return new PaginatedProjectListResponse(
      $project_responses,
      $project_count,
      $page_number,
      $projects_per_page * $page_number < $project_count ? $page_number + 1 : null,
      $page_number > 1 ? $page_number - 1 : null);
  }

  private static function map_item(
      Project $project) : ProjectResponse
  {
    return new ProjectResponse(
      $project->id,
      htmlspecialchars($project->title),
      htmlspecialchars($project->url),
      htmlspecialchars($project->description),
      isset($project->updated_at) ? htmlspecialchars($project->updated_at) : null);
  }
}

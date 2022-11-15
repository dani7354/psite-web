<?php


class ProjectMapper
{
  public static function MapList(
    array $projects,
    int $project_count) : PaginatedProjectListResponse
  {
    var $project_responses = [];

    foreach ($projects as $project)
    {
      $project_response = MapItem($project);
      $project_responses[] = $project_response;

    }

    return PaginatedProjectListResponse($project_responses, 0);
  }

  private static function MapItem(Project $project) : ProjectResponse
  {
    return ProjectResponse(
      $project->id,
      $project->title,
      $project->url,
      $project->description,
      $project->image);
  }
}

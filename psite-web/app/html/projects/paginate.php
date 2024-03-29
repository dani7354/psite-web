<?php
  require_once "../../initialize.php";

  use App\Db\ProjectDb;
  use App\Mapping\ProjectMapper;
  use App\Model\Project\PaginatedProjectListResponse;
  use App\Helper\Security\ErrorHandler;

  const PAGE_NUMBER = "page_number";
  const PAGE_ITEM_COUNT = "page_item_count";
  
  $project_images_path = IMG_PATH . "/projects/";
  $page_number = 1;
  $page_item_count = 10;

  try
  {
    if (isset($_GET[PAGE_NUMBER]))
    {
      $page_number = (int) $_GET[PAGE_NUMBER];
    }
    if (isset($_GET[PAGE_ITEM_COUNT]))
    {
      $page_item_count = (int) $_GET[PAGE_ITEM_COUNT];
    }

    $is_parameters_valid = $page_number >= 1 && $page_item_count >= 1;

    if (!$is_parameters_valid)
    {
      ErrorHandler::display_error_message_json("Invalid parameters!", 400);
    }

    $project_db = new ProjectDb();
    $project_count = $project_db->get_total_count();
    $projects = $project_db->get_page($page_number, $page_item_count);

    $paginated_response = ProjectMapper::map_list(
      $projects,
      $project_images_path,
      $project_count,
      $page_number,
      $page_item_count);

    header('Content-Type: application/json');
    print json_encode($paginated_response);
    exit;
  }
  catch (Exception $exception)
  {
    ErrorHandler::handle_exception_json($exception, 500, "Something went wrong!");
  }

<?php
namespace App\Service;

use App\Db\ProjectDb;

class ProjectService 
{
    private readonly ProjectDb $project_db;

    function __construct(ProjectDb $project_db) 
    {
        $this->project_db = $project_db;
    }

    function get_all_projects() : array
    {
        return $this->project_db->all();
    }

    function get_projects_page(int $page_number, int $limit) : array
    {
        return $this->project_db->get_page($page_number, $limit);
    }

    function get_project_count() : int
    {
        return $this->project_db->get_total_count();
    }

    function get_last_updated_projects(int $count) : array
    {
        return $this->project_db->get_last_updated_projects($count);
    }
}
?>
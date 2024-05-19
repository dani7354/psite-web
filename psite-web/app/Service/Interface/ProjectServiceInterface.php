<?php
    namespace App\Service\Interface;

    interface ProjectServiceInterface
    {
        public function get_all_projects() : array;
        public function get_projects_page(int $page_number, int $limit) : array;
        public function get_project_count() : int;
        public function get_last_updated_projects(int $count) : array;
    }

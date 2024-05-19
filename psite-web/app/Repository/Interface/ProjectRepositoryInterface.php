<?php
    namespace App\Repository\Interface;

    interface ProjectRepositoryInterface
    {
        public function all() : array;
        public function get_page(int $page_number, int $limit) : array;
        public function get_total_count() : int;
        public function get_last_updated_projects(int $count) : array;
    }

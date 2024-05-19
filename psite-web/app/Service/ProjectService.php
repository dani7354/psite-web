<?php
    namespace App\Service;

    use App\Repository\Interface\ProjectRepositoryInterface;
    use App\Service\Interface\ProjectServiceInterface;

    class ProjectService implements ProjectServiceInterface
    {
        private readonly ProjectRepositoryInterface $project_repository;

        public function __construct(ProjectRepositoryInterface $project_repository)
        {
            $this->project_repository = $project_repository;
        }

        public function get_all_projects() : array
        {
            return $this->project_repository->all();
        }

        public function get_projects_page(int $page_number, int $limit) : array
        {
            return $this->project_repository->get_page($page_number, $limit);
        }

        public function get_project_count() : int
        {
            return $this->project_repository->get_total_count();
        }

        public function get_last_updated_projects(int $count) : array
        {
            return $this->project_repository->get_last_updated_projects($count);
        }
    }

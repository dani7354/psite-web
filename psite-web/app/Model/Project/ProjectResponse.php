<?php
  namespace App\Model\Project;
  
  class ProjectResponse
  {
      public function __construct(
          public readonly int $id,
          public readonly string $title,
          public readonly string $url,
          public readonly string $description,
          public readonly ?string $image) { }
  }

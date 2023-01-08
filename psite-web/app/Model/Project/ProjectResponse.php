<?php
  namespace App\Model\Project;

  use JsonSerializable;

  class ProjectResponse implements JsonSerializable
  {
      public function __construct(
          public readonly int $id,
          public readonly string $title,
          public readonly string $url,
          public readonly string $description,
          public readonly ?string $image) { }

          public function jsonSerialize()
          {
             $json_data["id"] = $this->id;
             $json_data["title"] = $this->title;
             $json_data["url"] = $this->url;
             $json_data["description"] = $this->description;
             $json_data["image"] = $this->image;

             return $json_data;
           }
  }

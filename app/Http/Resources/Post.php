<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        $category = $this->categories[0] ?? [];
        return [
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'thumbnail' => $this->thumbnail,
            'category' => $category,
            'category_id' => $category->id ?? null,
            'slug' => $this->slug,
            'body' => $this->body,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

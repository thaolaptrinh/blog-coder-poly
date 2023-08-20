<?php

namespace App\View\Components\Widgets;

use App\Models\Post;
use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YouMayLikeWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public $relatedPosts;
    public $tag;

    public function __construct($currentPost, $limit = 3)
    {
        $currentTags = $currentPost->tags->pluck('id');

        $this->tag = Tag::find($currentTags[0] ?? null);

        $this->relatedPosts = Post::whereHas('tags', function ($query) use ($currentTags) {
            $query->whereIn('tags.id', $currentTags);
        })
            ->where('id', '!=', $currentPost->id)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.you-may-like-widget');
    }
}

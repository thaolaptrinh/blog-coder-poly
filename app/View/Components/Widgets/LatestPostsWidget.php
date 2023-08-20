<?php

namespace App\View\Components\Widgets;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LatestPostsWidget extends Component
{
    /**
     * Create a new component instance.
     */

    public $latestPosts;


    public function __construct(Post $currentPost = null, $limit = 4)
    {

        $limit = max(1, $limit);
        $query = Post::latest()->take($limit);

        if (!($currentPost instanceof Post)) {
            $currentPost = null;
        } else {

            $query->where('id', '!=', $currentPost->id);
        }

        $this->latestPosts = $query->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.latest-posts-widget');
    }
}

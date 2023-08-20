<?php

namespace App\View\Components\Widgets;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainRecentPostsWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public $recentPosts;

    public function __construct($limit = 9)
    {
        $limit = max(1, $limit);
        $this->recentPosts = Post::latest()->limit($limit)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.main-recent-posts-widget');
    }
}

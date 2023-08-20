<?php

namespace App\View\Components\Widgets;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopularPostsWidget extends Component
{
    /**
     * Create a new component instance.
     */

    public $popularPosts;
    public function __construct()
    {

        $categoriesWithPosts = Category::whereHas('posts')->take(5)->get();

        $this->popularPosts = $categoriesWithPosts->map(function ($category) {
            return $category->posts()->latest()->first();
        })->filter();

        if ($this->popularPosts->isEmpty()) {
            $this->popularPosts = null;
        }
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.popular-posts-widget');
    }
}

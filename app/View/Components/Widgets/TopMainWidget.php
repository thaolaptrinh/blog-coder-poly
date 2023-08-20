<?php

namespace App\View\Components\Widgets;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopMainWidget extends Component
{
    /**
     * Create a new component instance.
     */

    public $threeCategories;

    public function __construct()
    {

        $categoriesWithPosts = Category::whereHas('posts')->latest()->take(3)->get();

        $this->threeCategories = $categoriesWithPosts->map(function ($category) {
            return $category->load(['posts' => function ($query) {
                $query->latest()->take(4);
            }]);
        })->filter();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.top-main-widget');
    }
}

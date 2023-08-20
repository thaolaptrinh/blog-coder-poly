<?php

namespace App\View\Components\Widgets;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagsWidget extends Component
{
    /**
     * Create a new component instance.
     */

    public $tags;

    public function __construct()
    {
        $this->tags = \App\Models\Tag::withCount('posts')
            ->limit(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.widgets.tags-widget');
    }
}

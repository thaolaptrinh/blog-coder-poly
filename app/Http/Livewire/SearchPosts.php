<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchPosts extends Component
{
    public $search = '';
    public $perPage = 5;



    public function render()
    {
        $posts = [];
        $isShowMore = false;
        if ($this->search) {
            $posts = Post::search($this->search)->latest()->paginate($this->perPage);
            $isShowMore  = $posts->hasMorePages();
        }

        return view('livewire.search-posts', ['posts' => $posts, 'isShowMore' => $isShowMore]);
    }
}

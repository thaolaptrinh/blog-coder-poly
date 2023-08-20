<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CommentsPost extends Component
{

    public Post  $post;

    public function render()
    {
        
        return view('livewire.comments-post');
    }
}

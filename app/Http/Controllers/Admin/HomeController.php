<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HomeController extends Controller
{
    //

    protected $user;
    protected $post;
    protected $comment;

    public function __construct(User $user, Post $post, Comment $comment)
    {
        $this->user = $user;
        $this->post = $post;
        $this->comment = $comment;
    }


    public function __invoke()
    {
        $userCount = $this->countModel($this->user);
        $userCountToday = $this->countModelToday($this->user);

        $postCount = $this->countModel($this->post);
        $postCountToday = $this->countModelToday($this->post);

        $commentCount = $this->countModel($this->comment);
        $commentCountToday = $this->countModelToday($this->comment);

        return view('admin.home', compact('userCount', 'userCountToday', 'postCount', 'postCountToday', 'commentCount', 'commentCountToday'));
    
    }

    protected function countModel($model)
    {
        return $model::count();
    }

    protected function countModelToday($model)
    {
        return $model::where('created_at', '>=', Carbon::today())->count();
    }
}

<?php

namespace App\Http\Controllers;

use App\Enums\CommentStatus;
use App\Enums\PostLayout;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{


    public function index()

    {

        return view('guest.index');
    }

    public function post($slug)
    {

        try {
            $post = Post::withCount([
                'comments' => fn ($q) => $q->where('status', CommentStatus::APPROVED->value)
            ])
                ->with([
                    'author', 'categories', 'tags',
                    'comments' => fn ($q) => $q->where('status', CommentStatus::APPROVED->value)->withDepth()
                        ->defaultOrder()
                        ->get()
                        ->toFlatTree()
                ])
                ->whereSlug($slug)->firstOrFail();

            if (!$post->status->isPublished() || $post->is_private == 1) abort(403);


            return view('guest.post', compact('post'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return notFound();
        }
    }

    public function category($slug)
    {
        try {
            $category = Category::withCount('posts')->whereSlug($slug)->firstOrFail();

            $limitPerPage = 12;
            $posts = $category->posts()->latest()->paginate($limitPerPage);

            return view('guest.category', compact('category', 'posts'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return notFound();
        }
    }


    public function tag($slug)
    {

        try {
            $tag = Tag::withCount('posts')->whereSlug($slug)->firstOrFail();

            $limitPerPage = 12;

            $posts = $tag->posts()->latest()->paginate($limitPerPage);

            return view('guest.tag', compact('tag', 'posts'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return notFound();
        }
    }

    public function page($page)
    {

        try {
            $page = Page::whereSlug($page)->firstOrFail();
            return view('guest.page', compact('page'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return notFound();
        }
    }



    public function search(Request $request)
    {


        $page = $request->query('page', 1);
        $q = $request->query('q', '');


        $posts = Post::search($q)->paginate(12, ['*'], 'page', $page)->withQueryString();

        // $query = $request->query('q');


        // if ($query && strlen($query > 2)) {
        //     $searchValues  = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
        //     $posts = Post::query();


        //     $posts->where(function ($q) use ($searchValues) {
        //         foreach ($searchValues as $value) {
        //             $q->orWhere('title', 'like', "%{$value}%");
        //         }
        //     });

        //     $posts = $posts
        //         ->with(['author', 'categories', 'tags'])
        //         ->orderByDesc('created_at')
        //         ->paginate(9);

        //     return view('guest.search-posts', compact('posts', 'query'));
        // }

        return view('guest.search-posts', compact('posts'));
    }
}

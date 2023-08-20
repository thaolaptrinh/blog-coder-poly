<?php

namespace App\Http\Livewire\Admin;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{

    use WithPagination;

    protected $posts;

    public $search;

    public $perPage = 9;


    public $selectedPosts = [];
    public $selectAll = false;

    public $actionTarget;

    protected $listeners = [
        'delete-action' => 'deleteAction',
        'execute-action' => 'executeAction'
    ];



    public function delete($post)
    {

        $this->dispatchBrowserEvent('delete', [
            'title' => __('Are your sure?'),
            'text' => __("You won't be able to revert this!"),
            'id' => $post['id']
        ]);
    }

    public function deleteAction($id)
    {
        try {
            $post = Post::findOrFail($id);
            $post->delete();

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __("Deleted Successfully!")
            ]);
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __("Deleting Wrong!")
            ]);
        }
    }


    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->posts = Post::all();
            $this->selectedPosts = $this->posts->pluck('id')->map(function ($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedPosts = [];
        }
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedPosts)) {
            $this->actionTarget = 'delete';
            $this->dispatchBrowserEvent('delete-selected', [
                'title' => __('Are your sure?'),
                'text' => __("You won't be able to revert this!"),
            ]);
        }
    }

    public function executeAction($bool)
    {
        if (!$bool) return;

        switch ($this->actionTarget) {
            case 'delete':
                Post::whereIn('id', $this->selectedPosts)->delete();
                $this->selectAll = false;
                $this->selectedPosts = [];
                $this->actionTarget = '';

                break;

            default:
                break;
        }
    }


    public function render()
    {

        $user = auth()->user();
        $this->posts = $user->hasRole('administrator') ? Post::with('author')
            ->search($this->search)
            ->paginate($this->perPage) : $user->posts()->search($this->search)->paginate($this->perPage);

        return view('livewire.admin.posts', ['posts' => $this->posts]);
    }
}

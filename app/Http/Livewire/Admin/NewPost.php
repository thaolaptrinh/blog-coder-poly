<?php

namespace App\Http\Livewire\Admin;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewPost extends Component
{
    use WithFileUploads;

    public $title, $slug, $body, $category_id, $thumbnail, $layout, $is_private;
    public $status;


    public function mount()
    {
        $this->status = PostStatus::DRAFT->value;
        $this->is_private = 0;
    }


    protected function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|string|unique:posts,slug',
            'category_id' => 'nullable|integer|exists:categories,id',
            'is_private' => 'required|in:0,1',
            'body' => 'nullable|string',
            'status' => ['required', Rule::in(PostStatus::getValues())],
        ];
    }

    public function updatedThumbnail()
    {
        $this->validate([
            'thumbnail' => 'image|max:1024',
        ]);
    }


    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('clear-tinymce');
    }

    public function updated($propertyName)

    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {



        $validatedData =  $this->validate($this->rules());


        try {


            $post = new Post();


            $post->user_id = auth()->id();
            $post->title = $validatedData['title'];
            $post->slug = $validatedData['slug'];
            $post->body = $validatedData['body'];
            $post->status = $validatedData['status'];
            $post->is_private = $validatedData['is_private'];


            if ($this->thumbnail) {
                $filename = Str::slug(strtolower($post->title)) . time() . '.' . $this->thumbnail->getClientOriginalExtension();
                $thumbnailPath = $this->thumbnail->storeAs('photos', $filename, 'public');
                $validatedData['thumbnail'] = asset('storage/' . $thumbnailPath);
                $post->thumbnail = $validatedData['thumbnail'];
            }


            $post->save();


            PostCategory::create([
                'post_id' => $post->id,
                'category_id' => $validatedData['category_id']
            ]);


            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __('Created Successfully!')
            ]);

            $this->resetForm();


            // sleep(3);
            // return to_route('admin.posts.index');
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'message' => __('Creating Wrong!')
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.new-post');
    }
}

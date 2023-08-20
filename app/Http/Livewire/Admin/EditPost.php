<?php

namespace App\Http\Livewire\Admin;

use App\Enums\PostLayout;
use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;

    public $title, $slug, $category_id, $status, $is_private, $body, $thumbnail,  $layout,  $newThumbnail;

    public $post;



    protected function rules()
    {
        return [
            'title' => 'required|string',
            'slug' => 'required|string|unique:posts,slug,' . $this->post->id,
            'category_id' => 'nullable|integer|exists:categories,id',
            'is_private' => 'required|in:0,1',
            'body' => 'nullable|string',
            'status' => ['required', Rule::in(PostStatus::getValues())],
            'layout' => ['required', Rule::in(PostLayout::getValues())],
        ];
    }


    public function updated($propertyName)

    {
        $this->validateOnly($propertyName);
    }


    public function updatedNewThumbnail()
    {
        $this->validate([
            'thumbnail' => 'image|max:1024',
        ]);
    }




    public function mount(Post $post)
    {
        $this->post = $post;
        $this->category_id = $post->categories[0]->id ?? '';
        $this->status = $post->status->value;
        $this->layout = $post->layout->value;

        $this->fill($this->post->only([
            'title',
            'slug',
            'body',
            'is_private',
            'thumbnail',
        ]));
    }


    public function update()
    {

        $validatedData = $this->validate();

        try {



            $this->post->title = $validatedData['title'];
            $this->post->status = $validatedData['status'];
            $this->post->is_private = $validatedData['is_private'];
            $this->post->layout = $validatedData['layout'];
            $this->post->slug = $validatedData['slug'];
            $this->post->body = $validatedData['body'];



            if ($this->newThumbnail) {
                $filename = $this->title . '_thumbnail_' . time() . '.' . $this->newThumbnail->getClientOriginalExtension();
                $thumbnailPath = $this->newThumbnail->storeAs('photos', $filename, 'public');
                $validatedData['newThumbnail'] = asset('storage/' . $thumbnailPath);
                $this->post->thumbnail = $validatedData['newThumbnail'];
            }

            if ($this->category_id) {
                PostCategory::updateOrCreate([
                    'post_id' => $this->post->id,
                    'category_id' => $validatedData['category_id']
                ]);
            }


            $this->post->save();

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __('Updated Successfully!')
            ]);
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'message' => __('Updating Wrong!')
            ]);
        }
    }

    public function render()
    {
        return view('livewire.admin.edit-post');
    }
}

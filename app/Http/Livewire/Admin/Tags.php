<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Livewire\Component;

class Tags extends Component
{

    public $tags;

    public $name, $slug, $description;

    public $isCreation = true;

    public $search;
    public $selected_id;


    public $selectedTags = [];
    public $selectAll = false;
    public $actionTarget;



    protected $listeners = [
        'reset-form' => 'resetForm',
        'delete-action' => 'deleteAction',
        'execute-action' => 'executeAction'

    ];


    public function updatedName()
    {
        if ($this->isCreation) {
            $this->slug = Str::slug(strtolower($this->name));
        }
    }

    public function updatedSlug()
    {
        $this->isCreation = false;
    }


    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeModal');
    }



    public function store()
    {

        $validatedData = $this->validate([
            'name' => 'required|string|unique:tags,name',
            'slug' => 'required|string|unique:tags,slug',
            'description' => 'nullable|string',
        ]);


        try {
            $category = new Tag();

            $category->name = $validatedData['name'];
            $category->slug = Str::slug(strtolower($this->slug));
            $category->description = $validatedData['description'];

            $category->save();

            $this->resetForm();
        } catch (\Exception $e) {
        }
    }

    public function edit($tag)
    {


        $this->authorizeAction();

        $this->selected_id = $tag['id'];
        $this->name = $tag['name'];
        $this->slug = Str::slug(strtolower($tag['slug']));
        $this->description = $tag['description'];

        $this->isCreation = false;

        $this->dispatchBrowserEvent('showModal', ['name' => 'modal-edit']);
    }


    public function update()
    {
        $this->authorizeAction();


        try {

            $tag = Tag::findOrFail($this->selected_id);

            $validatedData = $this->validate([
                'name' => 'required|string|unique:tags,name,' . $tag->id,
                'slug' => 'required|string|unique:tags,slug,' . $tag->id,
                'description' => 'nullable|string',
            ]);


            $tag->name = $validatedData['name'];
            $tag->slug = Str::slug(strtolower($tag['slug']));
            $tag->description = $validatedData['description'];
            $tag->save();


            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __('Updated Successfully!')
            ]);

            $this->resetForm();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'message' => "Tag Not Found!"
            ]);
        }
    }





    public function delete($tag)
    {
        $this->authorizeAction();

        $this->dispatchBrowserEvent('delete', [
            'title' => __('Are your sure?'),
            'text' => __("You won't be able to revert this!"),
            'id' => $tag['id']
        ]);
    }

    public function deleteAction($id)
    {
        $this->authorizeAction();
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => "Deleted Successfully!"
            ]);
        } catch (\Exception $e) {

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => "Deleting Wrong!"
            ]);
            $this->resetForm();
        }
    }


    public function toggleSelectAll()
    {
        if ($this->selectAll) {
            $this->selectedTags = $this->tags->pluck('id')->map(function ($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedTags = [];
        }
    }


    public function deleteSelected()
    {
        if (!empty($this->selectedTags)) {
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
                Tag::whereIn('id', $this->selectedTags)->delete();
                $this->selectAll = false;
                $this->selectedTags = [];
                $this->actionTarget = '';

                break;

            default:
                break;
        }
    }


    protected function authorizeAction()
    {
        if (!Gate::allows('administrator')) {
            abort(403);
        }
    }


    public function render()
    {
        $this->tags = Tag::withCount('posts')->search($this->search)->get();

        return view('livewire.admin.tags');
    }
}

<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Categories extends Component
{

    use WithPagination;

    public $categories;

    public $name, $slug, $parent_id, $description;


    public $isCreation = true;

    public $search;
    public $selected_category_id;

    public $selectedCategories = [];
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
            'name' => 'required|string|unique:categories,name',
            'slug' => 'required|string|unique:categories,slug',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        try {

            $category = new Category();
            $category->name = $validatedData['name'];
            $category->slug = Str::slug(strtolower($this->slug));
            $category->description = $validatedData['description'];

            $parent = Category::find($validatedData['parent_id']);
            if ($parent) {
                $parent->appendNode($category);
            }

            $category->save();

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __('Created Successfully!')
            ]);

            $this->resetForm();
        } catch (\Exception $e) {
        }
    }

    public function edit($category)
    {


        $this->selected_category_id = $category['id'];
        $this->name = $category['name'];
        $this->slug = Str::slug(strtolower($category['slug']));
        $this->description = $category['description'];
        $this->parent_id = $category['parent_id'];

        $this->isCreation = false;

        $this->dispatchBrowserEvent('showModal', ['name' => 'modal-edit-category']);
    }


    public function update()
    {

        try {

            $category = Category::findOrFail($this->selected_category_id);

            $validatedData = $this->validate([
                'name' => 'required|string|unique:categories,name,' . $category->id,
                'slug' => 'required|string|unique:categories,slug,' . $category->id,
                'parent_id' => 'nullable|integer|exists:categories,id',
                'description' => 'nullable|string',
            ]);


            $category->name = $validatedData['name'];
            $category->slug = Str::slug(strtolower($category['slug']));
            $category->parent_id = $validatedData['parent_id'];
            $category->description = $validatedData['description'];
            $category->save();


            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __('Updated Successfully!')
            ]);

            $this->resetForm();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'message' => "Category Not Found!"
            ]);
        }
    }


    public function delete($category)
    {

        $this->dispatchBrowserEvent('delete', [
            'title' => __('Are your sure?'),
            'text' => __("You won't be able to revert this!"),
            'id' => $category['id']
        ]);
    }

    public function deleteAction($id)
    {
        try {
            $nodeToDelete = Category::findOrFail($id);

            $parentOfNodeToDelete = $nodeToDelete->parent;

            $children = $nodeToDelete->children;

            foreach ($children as $child) {
                $child->appendToNode($parentOfNodeToDelete)->save();
            }

            $nodeToDelete->delete();

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
            $this->selectedCategories = $this->categories->pluck('id')->map(function ($id) {
                return (string) $id;
            })->toArray();
        } else {
            $this->selectedCategories = [];
        }
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedCategories)) {
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
                Category::whereIn('id', $this->selectedCategories)->delete();
                $this->selectAll = false;
                $this->selectedCategories = [];
                $this->actionTarget = '';

                break;

            default:
                break;
        }
    }

    public function render()
    {

        $this->categories = Category::withDepth()
            ->with('ancestors')
            ->withCount('posts')
            ->search($this->search)
            ->defaultOrder()
            ->get()
            ->toFlatTree();

        return view('livewire.admin.categories');
    }
}

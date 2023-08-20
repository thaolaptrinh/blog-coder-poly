<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;


class UpdateInformation extends Component
{

    use WithFileUploads;

    public $user;


    public $photo, $newPhoto, $name, $email, $username, $bio, $company, $job_title, $github, $linkedin, $website;


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function updatedNewPhoto()
    {
        $this->validate([
            'newPhoto' => 'image|max:1024',
        ]);
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users,username,' . auth()->user()->id,
            'email' => ['nullable', 'email', 'max:255', Rule::unique(User::class)->ignore(auth()->user()->id)],
        ];
    }


    public function mount()
    {
        $this->user = auth()->user();


        $this->fill($this->user->only([
            'name',
            'username',
            'email',
        ]));
        $this->fill($this->user->info->only([
            'photo',
            'bio',
            'company',
            'job_title',
            'github',
            'linkedin',
            'website',
        ]));
    }


    public function save()
    {

        $validatedData = $this->validate();

        auth()->user()->update($validatedData);

        $userInfo = auth()->user()->info;

        if ($this->newPhoto) {
            $filename = $this->name . '_photo_' . time() . '.' . $this->newPhoto->getClientOriginalExtension();
            $photoPath = $this->newPhoto->storeAs('photos', $filename, 'public');
            $validatedData['photo'] = asset('storage/' . $photoPath);
            $userInfo->photo = $validatedData['photo'];
        }



        $userInfo->bio = $this->photo;
        $userInfo->bio = $this->bio;
        $userInfo->company = $this->company;
        $userInfo->job_title = $this->job_title;
        $userInfo->github = $this->github;
        $userInfo->linkedin = $this->linkedin;
        $userInfo->website = $this->website;

        $userInfo->save();

        return back()->with('status', 'profile-updated');
    }

    public function render()
    {
        return view('livewire.admin.profile.update-information');
    }
}

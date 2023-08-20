<?php

namespace App\Http\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UpdatePassword extends Component
{


    public $current_password, $password, $password_confirmation;



    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function save()
    {

        $validatedData = $this->validate();


        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', __('Your current password is incorrect.'));
            return;
        }

        auth()->user()->update([
            'password' => Hash::make($validatedData['password']),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        return back()->with('status', 'password-updated');
    }

    public function render()
    {
        return view('livewire.admin.profile.update-password');
    }
}

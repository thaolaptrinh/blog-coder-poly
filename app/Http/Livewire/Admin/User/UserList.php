<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

use Livewire\Component;
use Livewire\WithPagination;



class UserList extends Component
{
    use WithPagination;

    public $name, $username, $email, $role_id, $status = 1;


    public $search;
    public $perPage = 8;
    public $selected_user_id;


    protected $listeners = [
        'reset-form' => 'resetForm',
        'delete-user-action' => 'deleteUserAction',
    ];




    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->render();
    }

    public function resetForm()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->dispatchBrowserEvent('closeModal');
    }

    protected function rules(): array

    {
        return [
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'nullable|email|unique:users,email',
            'role_id' => 'required|integer|in:' . implode(',', Role::pluck('id')->toArray()),
            'status' => 'required|in:0,1'
        ];
    }


    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function newUser()
    {
        $validatedData = $this->validate();


        // User

        try {

            $user = new User();

            $user->name = $validatedData['name'];
            $user->username = $validatedData['username'];
            $user->email = $validatedData['email'];

            $password = Str::generate(8);

            $user->password = Hash::make($password);

            // Set role to user

            $user->assignRole($validatedData['role_id']);

            $user->save();

            // Infos
            $userInfo = new UserInfo();

            $userInfo->user_id = $user->id;
            $userInfo->status = $validatedData['status'];
            $userInfo->save();

            $dataMail  = [
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $password,
                'url' => route('admin.profile.edit'),
            ];


            // Send data create to user
            Mail::send('email-templates.new-user', $dataMail, function ($message) {
                $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                $message->to($this->email, $this->name)
                    ->subject(__("Account creation"));
            });


            $this->resetForm();

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __("Created Successfully!")
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating user: ' . $e->getMessage());

            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'message' => __("Something wrong!")
            ]);
        }
    }


    public function editUser($user)
    {


        $this->selected_user_id = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->role_id = $user['roles'][0]['id'];
        $this->status = $user['info']['status'];


        $this->dispatchBrowserEvent('showModal', ['name' => 'modal-edit-user']);
    }


    public function updateUser()
    {

        try {



            $user = User::findOrFail($this->selected_user_id);


            $validatedData = $this->validate([
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username,' . $user->id,
                'email' => 'nullable|email|unique:users,email,' .  $user->id,
                'role_id' => 'required|integer|in:' . implode(',', Role::pluck('id')->toArray()),
                'status' => 'required|in:0,1'
            ]);




            $user->name =  $validatedData['name'];
            $user->email =  $validatedData['email'];
            $user->username =  $validatedData['username'];



            $user->syncRoles($validatedData['role_id']);

            $user->save();

            UserInfo::where('user_id', $user->id)->update([
                'status' => $validatedData['status']
            ]);

            $this->dispatchBrowserEvent('toast', [
                'type' => 'success',
                'message' => __('Updated Successfully!')
            ]);

            $this->resetForm();
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', [
                'type' => 'error',
                'message' => __("Updating Wrong!")
            ]);
        }
    }



    public function deleteUser($user)
    {
        $this->dispatchBrowserEvent('deleteUser', [
            'title' => __('Are your sure?'),
            'text' => __("You won't be able to revert this!"),
            'id' => $user['id']
        ]);
    }


    public function deleteUserAction($id)
    {


        try {
            $user = User::findOrFail($id);

            $user->delete();

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


    public function render()
    {

        $users = User::search(trim($this->search))
            ->where('id', '<>', auth()->id())->paginate($this->perPage)->withQueryString();

        return view(
            'livewire.admin.user.user-list',
            compact('users')
        );
    }
}

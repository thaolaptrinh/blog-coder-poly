<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\UserInfo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.index', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();


        $userInfo = UserInfo::find(auth()->user()->id);


        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = Str::slug(auth()->user()->name) . '-photo' . time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/photos');
            $image->move($destinationPath, $name);
            $userInfo->photo = asset('storage/photos/' . $name);
        }

        $userInfo->bio = $request->bio;
        $userInfo->company = $request->company;
        $userInfo->job_title = $request->job_title;
        $userInfo->github = $request->github;
        $userInfo->linkedin = $request->linkedin;
        $userInfo->website = $request->website;

        $userInfo->save();

        return Redirect::route('admin.profile.index')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('manage-user', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('update-user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = $this->validatorUser($request->all(), $user->id);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Storage::disk('local')->delete('public/'.$user->profile_picture);
        $file_name = Carbon::now()->timestamp.'.'.$request->profile_picture->extension();
        Storage::disk('local')->put('public/profile_pictures/'.$file_name, file_get_contents($request->profile_picture));
        $filename = 'profile_pictures/'.$file_name;

        $user = $this->updateProfile($request->all(), $filename, $user->id);

        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::disk('local')->delete('public/'.$user->profile_picture);
        $user->delete();
        return redirect('/admin/user');
    }

    protected function validatorUser(array $data, $user_id)
    {
        return Validator::make($data, [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users')->ignore($user_id, 'id')],
            'phone' => ['required', 'integer', 'digits_between:8,12'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'address' => ['required', 'min:10'],
            'profile_picture' => ['required', 'mimes:jpeg,png,jpg']
        ]);
    }

    protected function updateProfile(array $data, $filename, $user_id)
    {
        return User::where('id', $user_id)->first()->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'profile_picture' => $filename,
        ]);
    }
}

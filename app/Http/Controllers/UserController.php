<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();

        return view('user.index', $data);
    }

    public function create()
    {
        $data['divisions'] = Division::all();

        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'id_number' => 'required|max:11|unique:users',
            'name' => 'required|max:225',
            'gender' => 'required',
            'role' => 'required',
            'email' => 'required|email|max:225|unique:users',
            'profile_photo_path' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        if ($request->file('profile_photo_path')->isValid()) {
            $avatarFile = $request->file('profile_photo_path');
            $extension = $avatarFile->getClientOriginalExtension();
            $fileName = date('YmdHis') . "." . $extension;
            $request->file('profile_photo_path')->move(public_path('upload/profile_photo_path'), $fileName);
            $input['profile_photo_path'] = $fileName;
        }

        $input['password'] = password_hash($request->get('email'), PASSWORD_BCRYPT);

        User::create($input);

        $status = array(
            'message' => 'User successfully added.',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($status);
    }

    public function edit($id)
    {
        $data['users'] = User::findOrFail($id);
        $data['divisions'] = Division::all();

        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $data = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'name' => 'required|max:225',
            'gender' => 'required',
            'role' => 'required',
            'email' => 'required|email|max:225',
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        if ($request->file('profile_photo_path')) {
            $avatarFile = $request->file('profile_photo_path');
            @unlink(public_path('upload/profile_photo_path/' . $data->profile_photo_path));
            $extension = $avatarFile->getClientOriginalExtension();
            $fileName = date('YmdHis') . "." . $extension;
            $request->file('profile_photo_path')->move(public_path('upload/profile_photo_path'), $fileName);
            $input['profile_photo_path'] = $fileName;
        }

        $data->update($input);

        $status = array(
            'message' => 'User successfully updated.',
            'alert-type' => 'success'
        );

        return redirect()->route('user.index')->with($status);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user || count($user->overall)>0){
            $status = array(
                'message' => 'User unsuccessfully deleted.',
                'alert-type' => 'info'
            );
        }else{
            $user->delete();
            @unlink(public_path('upload/profile_photo_path/' . $user->profile_photo_path));
            $status = array(
                'message' => 'User successfully deleted.',
                'alert-type' => 'success'
            );
        }
        return redirect()->back()->with($status);
    }
}

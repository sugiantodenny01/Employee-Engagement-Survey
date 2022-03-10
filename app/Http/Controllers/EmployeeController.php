<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        $data['employees'] = Employee::all();

        return view('employee.index', $data);
    }

    public function create()
    {
        $data['divisions'] = Division::all();

        return view('employee.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'id_number' => 'required|max:11|unique:employees',
            'name' => 'required|max:225',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'join_date' => 'required',
            'role' => 'required',
            'email' => 'required|email|max:225',
            'education' => 'required',
            'address' => 'required|max:225',
            'phone' => 'required|digits_between:10, 12',
            'avatar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        if ($request->file('avatar')->isValid()) {
            $avatarFile = $request->file('avatar');
            $extension = $avatarFile->getClientOriginalExtension();
            $fileName = date('YmdHis') . "." . $extension;
            $request->file('avatar')->move(public_path('upload/employee_avatars'), $fileName);
            $input['avatar'] = $fileName;
        }

        $input['password'] = password_hash($request->get('email'), PASSWORD_BCRYPT);

        Employee::create($input);

        $status = array(
            'message' => 'Employee successfully added.',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.index')->with($status);
    }

    public function edit($id)
    {
        $data['employees'] = Employee::findOrFail($id);
        $data['divisions'] = Division::all();

        return view('employee.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $data = Employee::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'division_id' => 'required',
            'name' => 'required|max:225',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'join_date' => 'required',
            'role' => 'required',
            'email' => 'required|email|max:225',
            'education' => 'required',
            'address' => 'required|max:225',
            'phone' => 'required|digits_between:10, 12',
            'avatar' => 'sometimes|nullable|image|mimes:jpeg,jpg,png|max:2048',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        if ($request->file('avatar')) {
            $avatarFile = $request->file('avatar');
            @unlink(public_path('upload/employee_avatars/' . $data->avatar));
            $extension = $avatarFile->getClientOriginalExtension();
            $fileName = date('YmdHis') . "." . $extension;
            $request->file('avatar')->move(public_path('upload/employee_avatars'), $fileName);
            $input['avatar'] = $fileName;
        }

        $data->update($input);

        $status = array(
            'message' => 'Employee successfully updated.',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.index')->with($status);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        $status = array(
            'message' => 'Employee successfully deleted.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($status);
    }

    public function resetPassword($id)
    {
        $data = Employee::findOrFail($id);

        $data->update(['password' => password_hash($data->email, PASSWORD_BCRYPT)]);

        $status = array(
            'message' => 'Password successfully reseted.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($status);
    }
}

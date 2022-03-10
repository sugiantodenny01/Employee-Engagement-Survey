<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisionController extends Controller
{
    public function index()
    {
        $data['divisions'] = Division::where('name','!=','All Division')->get();
//      $divisions=Division::where('name','!=','All Division')->get();


        return view('division.index', $data);
    }

    public function create()
    {
        return view('division.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        Division::create($input);

        $status = array(
            'message' => 'Division successfully added.',
            'alert-type' => 'success'
        );

        return redirect()->route('division.index')->with($status);
    }

    public function edit($id)
    {
        $data['divisions'] = Division::findOrFail($id);

        return view('division.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $division = Division::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:225',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $input = $request->all();

        $division->update($input);

        $status = array(
            'message' => 'Division successfully updated.',
            'alert-type' => 'success'
        );

        return redirect()->route('division.index')->with($status);
    }

    public function destroy($id)
    {
        $division = Division::find($id);

        if (!$division || count($division->user)>0){
            $status = array(
                'message' => 'Division unsuccessfully deleted.',
                'alert-type' => 'info'
            );
        }else{
            $division->delete();
            $status = array(
                'message' => 'Division successfully deleted.',
                'alert-type' => 'success'
            );
        }


        return redirect()->back()->with($status);
    }
}

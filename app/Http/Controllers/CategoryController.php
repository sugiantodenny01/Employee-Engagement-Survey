<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::all();

        return view('category.index', $data);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categoryCheckNameSame=Category::where("name",$request->name)->first();
        if ($categoryCheckNameSame){
            $status = array(
                'message' => 'Category already added.',
                'alert-type' => 'info'
            );

        }else{
            $input = $request->all();
            Category::create($input);

            $status = array(
                'message' => 'Category successfully added.',
                'alert-type' => 'success'
            );
        }


        return redirect()->route('category.index')->with($status);
    }

    public function edit($id)
    {
        $data['categories'] = Category::findOrFail($id);

        return view('category.edit', $data);
    }

    public function update(Request $request, $id)
    {

        $category = Category::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:225',
        ]);

        if ($validator->fails() || !$category) {
            return redirect()->back()->withErrors($validator);
        }


        $categoryCheckNameSame=Category::where("name",$request->name)->where('id','!=',$id)->first();
        if ($categoryCheckNameSame){
            $status = array(
                'message' => 'Failed update Category.',
                'alert-type' => 'info'
            );
            return redirect()->route('category.index')->with($status);

        }


        $input = $request->all();
        $category->update($input);
        $status = array(
            'message' => 'Category successfully updated.',
            'alert-type' => 'success'
        );

        return redirect()->route('category.index')->with($status);
    }

    public function destroy($id)
    {
        $category = Category::find($id);


        if (!$category || count($category->CategoryDetail)>0){

            $status = array(
                'message' => 'Failed to delete category',
                'alert-type' => 'info'
            );

        }else{
            $category->delete();
            $status = array(
                'message' => 'Category successfully deleted.',
                'alert-type' => 'success'
            );

        }

        return redirect()->back()->with($status);

    }
}

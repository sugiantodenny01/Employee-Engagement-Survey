<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\ListAssessments;
use App\Models\Overall;
use App\Repository\CoreAssessment;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryDetailController extends Controller
{
    public function index()
    {
        $data['category_details'] = CategoryDetail::all();

        return view('category_detail.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::all();

        return view('category_detail.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|max:300',
            'quality' => 'required|numeric|between:-5,200',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $checkName=CategoryDetail::where('name',$request->name)->first();
        if ($checkName){
            $status = array(
                'message' => 'Category detail cant added because of name already taken.',
                'alert-type' => 'success'
            );
            return redirect()->route('category_detail.index')->with($status);
        }

        $input = $request->all();

        CategoryDetail::create($input);

        $status = array(
            'message' => 'Category detail successfully added.',
            'alert-type' => 'success'
        );

        return redirect()->route('category_detail.index')->with($status);
    }

    public function edit($id)
    {
        $data['category_details'] = CategoryDetail::findOrFail($id);
        $data['categories'] = Category::all();

        return view('category_detail.edit', $data);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category_detail = CategoryDetail::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'name' => 'required|max:300',
                'quality' => 'required|numeric|between:-5,100',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $checkCantUpdate=CategoryDetail::where('id',$id)->whereIn('name',[
                'Jumlah hari masuk kantor yang dibuktikan dengan absen datang dan absen pulang',
                'Jumlah hari penugasan dinas yang dibuktikan dengan Surat Perintah Perjalanan Dinas',
                'Jumlah hari Ganti Libur sebagai kompensasi lembur yang dibuktikan dengan Surat Perintah Kerja Lembur',
                'Jumlah hari penugasan lembur pada hari libur yang dibuktikan dengan surat Perintah Kerja Lembur',
            ])->first();

            if ($checkCantUpdate) {
                throw new Exception();
            }

            $checkJumlahHariKerja=CategoryDetail::where([['id', $id], ['name', 'Jumlah hari kerja dalam satu bulan']])->first();
            if ($checkJumlahHariKerja) {
                if ($request->name != $checkJumlahHariKerja->name || $request->category_id != $checkJumlahHariKerja->category_id) {
                    throw new Exception();
                }
            }

            $input = $request->all();
            $category_detail->update($input);

            $status = array(
                'message' => 'Category detail successfully updated.',
                'alert-type' => 'success'
            );

            $checkTest = ListAssessments::where('used', true)->get();
            foreach ($checkTest as $test) {
                $checkOverall = Overall::where('listassessment_id', $test->id)->where('categorydetail_id', $id)->get();
                foreach ($checkOverall as $overall) {
                    $check= CoreAssessment::calculationOverallTable($overall->categorydetail_id, $overall->categoryDetail->category->id, $test->id,$overall->user_id, $overall->nilai);
                    CoreAssessment::calculationTestByCategory($overall->user_id,$overall->categoryDetail->category->id,$test->id);

                    if (is_numeric($check)){

                        $dataDependentOn=Overall::where([['listassessment_id',$test->id],['user_id',$overall->user_id]])->whereHas('categoryDetail',function ($q){
                            $q->whereIn('name',[
                                'Jumlah hari masuk kantor yang dibuktikan dengan absen datang dan absen pulang',
                                'Jumlah hari penugasan dinas yang dibuktikan dengan Surat Perintah Perjalanan Dinas',
                                'Jumlah hari Ganti Libur sebagai kompensasi lembur yang dibuktikan dengan Surat Perintah Kerja Lembur',
                                'Jumlah hari penugasan lembur pada hari libur yang dibuktikan dengan surat Perintah Kerja Lembur'
                            ]);

                        })->get();

                        foreach ($dataDependentOn as $data){
                            CoreAssessment::calculationOverallTable($data->categorydetail_id, $data->categoryDetail->category->id, $test->id,$data->user_id, $data->nilai,$check);
                            CoreAssessment::calculationTestByCategory($data->user_id,$data->categoryDetail->category->id,$test->id);
                        }

                    }

                }

            }

            DB::commit();
            return redirect()->route('category_detail.index')->with($status);

        }catch (Exception $e){
            DB::rollback();
            Session::flash('message', 'Category detail cant updated.');
            Session::flash('alert-type', 'error');
            return redirect()->route('category_detail.index');

        }
    }

    public function destroy($id)
    {
        $category_detail = CategoryDetail::find($id);

        if (!$category_detail || count($category_detail->overall)>0){

            $status = array(
                'message' => 'Failed to delete category detail',
                'alert-type' => 'info'
            );

        }else{
            $category_detail->delete();
            $status = array(
                'message' => 'Category detail successfully deleted',
                'alert-type' => 'success'
            );

        }

        return redirect()->back()->with($status);
    }
}

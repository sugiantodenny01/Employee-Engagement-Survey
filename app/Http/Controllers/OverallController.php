<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\CoreAssessment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OverallController extends Controller
{
    public function index(){
        $data=CoreAssessment::checkUserActiveAssessment(); #untuk check test active dan user active
        $checkListAssessmentActiveNow=$data['checkListAssessmentActiveNow'];
        $listUserAssessment=User::whereIn('id', $data['user'])->get();
        return view("overall.index", compact('listUserAssessment','checkListAssessmentActiveNow'));
    }

    public function test($userId,$testId){

        $userId=decrypt($userId);
        $testId=decrypt($testId);
        $user=User::find($userId);
        return view('overall.test',compact('userId','testId','user'));
    }


    public function testByCategory($categoryId,$testId,$userId){
        $categoryId != 0 || $categoryId != '' ? $categoryDetails=CategoryDetail::where('category_id',$categoryId)->get() : $categoryDetails=[];
        return view('components.testByCategory',compact('categoryDetails','categoryId','testId','userId'));
    }

    public function processTest(Request $request){


       $calculation=CoreAssessment::insertData($request->score,$request->categoryId,$request->testId, $request->userId);

       #Pengecekan jika terjadi error dengan tanda jika $calculation nya bernilai false
       if (!$calculation){
           return response()->json(['success'=>false]);
       }else{
           return response()->json(['success'=>true]);

       }

    }


    public function getForm($userId,$testId,$history=null){

        $dataUser=Auth::user()->division->name;
        #Untuk pengecekan
        if ($dataUser == "Divisi Umum" || $dataUser == "All Division"){
            $categorys=Category::has('categoryDetail')->get();

        }else{
            $categorys=Category::where('name','!=' ,'Kedisiplinan Kerja')->has('categoryDetail')->get();
        }
        return view('components.formSelect',compact('userId','testId','categorys','history'));

    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\ListAssessments;
use App\Models\Overall;
use App\Models\OverallCategory;
use App\Models\Result;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;


class HistoryController extends Controller
{


    public function index(){
        $data['users'] = User::where([['role','!=','director'],['role','!=','admin']])->get();
        return view('history.index',$data);
    }


    public function listTest($userId){
        $userId=decrypt($userId);

        $user=User::find($userId);
        #untuk get list test yang aktif dan telah digunakan
        $test=ListAssessments::where('used',true)->get();
        #
        return view('history.historyTest',compact('test','userId','user'));
    }



    public function generateHistory($userId,$testId){

        $userId=decrypt($userId);
        $testId=decrypt($testId);
        $data=[];

        if (User::find($userId) && ListAssessments::find($testId)) {
            $data=self::coreHistory($userId,$testId);
        }
        return view('history.result', $data);

    }

    public function generatePdf($userId,$testId){

        $data=self::coreHistory($userId,$testId);
        $data['userName']=User::find($userId)->name;
        $data['test']=ListAssessments::find($testId);
        $pdf = PDF::loadView('history.pdf',$data);
        return $pdf->download(''.$data['userName'].'-'.Carbon::parse($data['test']->start)->format('M Y').'.pdf');

    }


    public function coreHistory($userId,$testId){

        $categorys=Category::has('categoryDetail')->get();
        $arrList=[];

        //array->untuk setiap category yang mempunyai category details
        foreach ($categorys as $category) {
            $detailCategory = CategoryDetail::where('category_id', $category->id)->get();
            $overall = Overall::where([["user_id", $userId],['listassessment_id', $testId]])->whereIn('categorydetail_id',$detailCategory->pluck('id'))->get();
            $overallCategory = OverallCategory::where([['user_id', $userId], ['listassessment_id', $testId], ['category_id', $category->id]])->first();


            $listQuestionAndValueEachCategory = [];
            $insideEachCategory = [];
            foreach ($detailCategory as $detail) {
                foreach ($overall as $eachOverall) {
                    if ($eachOverall->categorydetail_id == $detail->id) {
                        $listQuestionAndValueEachCategory[] = array('soal' => $detail->name, 'nilai' => $eachOverall->nilai, 'quality' => $detail->quality, 'nadj' => $eachOverall->nadj);
                        #klau ingin memakai notasi objek
                        /*
                        $listQuestionAndValueEachCategory[]= (object) array('soal'=>$eachOverall->name,'nilai'=> $eachOverall->nadj);
                        */
                        #
                        $insideEachCategory['soal'] = $listQuestionAndValueEachCategory;
                        break;
                    }
                }
            }

            if ($overallCategory) {
                $insideEachCategory['sumCategory'] = $overallCategory->subtotal;
            } else {
                $insideEachCategory['sumCategory'] = 0;
            }

            $arrList[$category->name] = $insideEachCategory;
        }

        if ( $nilaiTotal = Result::where([['user_id', $userId], ['listassessment_id', $testId]])->first()) {
            $nilaiTotal = $nilaiTotal->score;
        }else{
            $nilaiTotal = 0;
        }


        $data['nilaiTotal']=$nilaiTotal;
        $data['arrList']=$arrList;
        $data['userId']=$userId;
        $data['testId']=$testId;

        return $data;

    }

}

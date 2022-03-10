<?php

namespace App\Http\Controllers;

use App\Models\ListAssessments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ListAssessmentsController extends Controller
{

    public function index(){

        $listAssessments=ListAssessments::orderBy("start")->get();
        return view("list_assessment.index", compact('listAssessments'));
    }

    public function create(){
        return view("list_assessment.create");
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'detail' => 'required',
            'start'  => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = array(
            'message' => 'list assessments already added.',
            'alert-type' => 'info'
        );

        $check=self::checking($request->start);
        if (!$check){
            return redirect()->route('list_assessment.index')->with($status);
        }


        $date      = Carbon::createFromFormat('Y-m-d', $request->start.="-1");
        $checkData = ListAssessments::whereMonth('start',$date)->whereYear('start',$date)->first();

        if (!$checkData){
            ListAssessments::create([
                'detail' => $request->detail,
                'start'  => $date
            ]);

            $status = array(
                'message' => 'store a new of list assessments successfully.',
                'alert-type' => 'success'
            );
        }


        return redirect()->route('list_assessment.index')->with($status);
    }

    public function edit($id){
        $listAssessments=ListAssessments::find($id);

        return view('list_assessment.edit', compact('listAssessments'));

    }


    public function update(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'detail' => 'required',
            'start'  => 'required|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status = array(
            'message' => 'Failed update list assessments.',
            'alert-type' => 'info'
        );

        $dataUpdate=ListAssessments::find($id);


        $check=self::checking($request->start);
        if(!$check || !$dataUpdate){
            return redirect()->route('list_assessment.index')->with($status);
        }


        $date  = Carbon::createFromFormat('Y-m-d', $request->start.="-1");
        $updateListAssessments=ListAssessments::where([['id',$id],['used',1]])->first();

        if ($updateListAssessments){
            if (Carbon::createFromFormat('Y-m-d', $updateListAssessments->start)->eq($date)){
                $updateListAssessments->update([
                    'detail' => $request->detail,
                    'start'  => $date
                ]);

            }else{
                return redirect()->route('list_assessment.index')->with($status);
            }

        }else{
            $checkData=ListAssessments::whereMonth('start',$date)->whereYear('start', $date)->where('id',$id)->first();

            if ($checkData){
                $dataUpdate->update([
                    'detail' => $request->detail,
                    'start'  => $date
                ]);

            }else{
                return redirect()->route('list_assessment.index')->with($status);

            }

        }

        $status = array(
            'message' => 'update list assessments successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('list_assessment.index')->with($status);
    }


    public function destroy($id){
        $checkDeleteData=ListAssessments::find($id);

        if (!$checkDeleteData || $checkDeleteData->used == 1){

            $status = array(
                'message' => 'Failed to remove list assessments.',
                'alert-type' => 'info'
            );

        }else{

            $checkDeleteData->delete();
            $status = array(
                'message' => 'list assessments successfully removed.',
                'alert-type' => 'success'
            );

        }

        return redirect()->route('list_assessment.index')->with($status);
    }


    public function checking($date){
        $dateMonthArray = explode('-', $date);

        if (count($dateMonthArray)!=2){
            return  false;
        }
        $yearLength  = strlen($dateMonthArray[0]);
        $monthLength = strlen($dateMonthArray[1]);
        if ($yearLength != 4 || $monthLength != 2){
           return false;
        }

        return true;

        //about Request
        //https://www.quora.com/What-does-Request-request-mean-in-Laravel
        // secara garis beras $request adalah inisialisai type objek dari class Request
        //https://www.php.net/manual/en/language.types.declarations.php ->example 9
        // klau di golang x type
        //klau php, java dll type x


    }


}

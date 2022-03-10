<?php
namespace App\Repository;
use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\ListAssessments;
use App\Models\Overall;
use App\Models\OverallCategory;
use App\Models\Result;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class CoreAssessment {

    public static function insertData($data,$categoryId,$testId,$userId){
        DB::beginTransaction();
        try {
            $dependentValue=null;

            foreach ($data as $categoryDetailId => $nilai) {
                if (is_numeric($nilai)) {

                   #Memanggil function untuk menghitung Overall table -> kenapa dipisah karena function menghitung Overall table nya dipanggil bberapa kali ditempat yang berbeda
                   $calculateOverallTable=self::calculationOverallTable($categoryDetailId,$categoryId,$testId,$userId,$nilai,$dependentValue);
                   #

                   if (is_numeric($calculateOverallTable)){
                       $dependentValue=$calculateOverallTable;
                   }elseif (!$calculateOverallTable){
                       throw new Exception();
                   }

                }
            }

            $calculation=self::calculationTestByCategory($userId,$categoryId,$testId);

            if (!$calculation){
                throw new Exception();
            }

            DB::commit();
            return true;

        }catch (Exception $e) {

             DB::rollback();
             return false;
        }
    }


    public static function calculationTestByCategory($userId,$categoryId,$testId){
        DB::beginTransaction();
        try {
            $category=Category::find($categoryId);
            $categoryDetail=$category->categoryDetail()->where('name','!=','Jumlah hari kerja dalam satu bulan')->get();
            $getOverall=Overall::where([['user_id',$userId],['listassessment_id',$testId]])->whereIn('categorydetail_id', $categoryDetail->pluck('id'))->get();
            #Perhitungan nilai Sum-Total
            if (Category::where([['id',$category->id],['name','Kedisiplinan Kerja']])->first()){
                $jumlah = $getOverall->sum('nadj');

            }else{
                $jumlah = ( ($getOverall->sum('nadj')/$categoryDetail->sum('quality') ) * 100 );
            }

            OverallCategory::updateOrCreate(
                [
                    'listassessment_id' =>  $testId,
                    'user_id' => $userId,
                    'category_id' => $category->id,
                ],
                ['subtotal' => $jumlah]
            );
            #Done

            $calculationResult=self::calculationFinalResult($userId,$testId);

            if (!$calculationResult) {
                throw new Exception();
            }

            DB::commit();
            return true;


        }catch (Exception $e) {

            DB::rollback();
            return false;
        }

    }

    public static function calculationFinalResult($userId, $testId){
        DB::beginTransaction();
        try {
            $getScore = OverallCategory::where([['listassessment_id', $testId], ['user_id', $userId]])->get();
            #Perhitungan nilai Total
            $total = (($getScore->sum('subtotal'))/400) * 100 ;
            Result::updateOrCreate(
                [
                    'listassessment_id' => $testId,
                    'user_id' => $userId,
                ],  ['score'  => $total ]
            );
            DB::commit();
            return true;
            #Done
        }catch (Exception $e) {

            DB::rollback();
            return false;
        }
    }

    public static function getValue($testId,$userId,$categoryDetails){
        #untuk get value test jika user telah mengisi test
        $value=Overall::where([
            ['listassessment_id', $testId],['user_id',$userId],['categorydetail_id',$categoryDetails]
        ])->first('nilai');
        $value ?  $value=$value->nilai : null;
        return $value;
    }

    public static function checkInputValue($categoryId, $value) {
        #untuk check input value sudah sesuai atau belom
        $category=Category::find($categoryId);
        $low=0;
        $category->name == "Kedisiplinan Kerja" ?  $high=30 : $high=10;

        if((int)$value < $low) return false;
        if((int)$value > $high) return false;
        return true;
    }

    public static function checkUserActiveAssessment(){
        #Digunakan untuk check active bulan aktif dan test active
        $getMonthNow=Carbon::now()->format('m');
        $getYearNow=Carbon::now()->format('Y');
        $checkListAssessmentActiveNow=ListAssessments::whereMonth('start',$getMonthNow)->whereYear('start',$getYearNow)->first();

        $listUser = [];
        if ($checkListAssessmentActiveNow) {
            if ($checkListAssessmentActiveNow->used != 1) {
                $checkListAssessmentActiveNow->used = 1;
                $checkListAssessmentActiveNow->save();
            }
            #

            #Digunakan untuk check user active dan user yang belom selesai test active
            $allUser = User::where([['role', '!=', 'director'], ['role', '!=', 'admin'], ['status', 'active']])->get();
            $totalCategory = Category::count();
            foreach ($allUser as $user) {
                $totalCategoryEachTest = $user->overallCategory()->where('listassessment_id', $checkListAssessmentActiveNow->id)->count('category_id');
                if ($totalCategoryEachTest != $totalCategory) {
                    $listUser[] = $user->id;
                }
            }
        }
        #

        $data=[];
        $data['user']=$listUser;
        $data['checkListAssessmentActiveNow']=$checkListAssessmentActiveNow;
        return $data;
    }

    public static function calculationOverallTable($categoryDetailId, $categoryId,$testId,$userId, $nilai, $dependentValue=null){
        DB::beginTransaction();
        try {
            $checkCategory = Category::where([['name', 'Kedisiplinan Kerja'], ['id', $categoryId]])->first();
            $detailCategory = CategoryDetail::find($categoryDetailId);
            $checkValue = self::checkInputValue($detailCategory->category->id, $nilai);

            if ($checkValue) {
                #Perhitungan nilai N-Adjective
                if ($checkCategory) {

                        $checkDetailCategory = CategoryDetail::where([['id', $categoryDetailId], ['name', 'Jumlah hari kerja dalam satu bulan']])->first();
                        $checkDetailCategoryDependentOn=CategoryDetail::where('id',$categoryDetailId)->whereIn('name',[
                            'Jumlah hari masuk kantor yang dibuktikan dengan absen datang dan absen pulang',
                            'Jumlah hari penugasan dinas yang dibuktikan dengan Surat Perintah Perjalanan Dinas',
                            'Jumlah hari Ganti Libur sebagai kompensasi lembur yang dibuktikan dengan Surat Perintah Kerja Lembur',
                            'Jumlah hari penugasan lembur pada hari libur yang dibuktikan dengan surat Perintah Kerja Lembur'
                        ])->first();

                        if ($checkDetailCategory) {
                            $nadj = $detailCategory->quality / $nilai;
                            $dependentValue=$nadj;

                        }elseif ($checkDetailCategoryDependentOn && is_numeric($dependentValue)) {
                           $nadj=$dependentValue * $nilai;

                        }else {
                           $nadj = $detailCategory->quality * $nilai;
                        }

                } else {
                    $nadj = ($detailCategory->quality / 10) * $nilai;
                }

                Overall::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'listassessment_id' => $testId,
                        'categorydetail_id' => $categoryDetailId
                    ],
                    ['nilai' => $nilai, 'nadj' => $nadj]
                );
                #Done

                DB::commit();

                if (is_numeric($dependentValue)){
                    return $dependentValue;
                }else{
                    return true;
                }

            }else{
                throw new Exception();
            }


        }catch (Exception $e) {
            DB::rollback();
            return false;
        }

    }

}

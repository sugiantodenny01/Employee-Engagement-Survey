<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use App\Models\Division;
use App\Models\User;
use App\Repository\CoreAssessment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function index()
    {
        $data['employees'] = User::where('role', 'head of division')
            ->orWhere('role', 'staff')
            ->count();
        $data['divisions'] = Division::count();
        $data['categories'] = Category::count();
        $data['category_details'] = CategoryDetail::count();

        $userActiveTest=CoreAssessment::checkUserActiveAssessment();
        $data['user_active']=collect($userActiveTest['user'])->count();



        return view('admin.index', $data);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Criteria;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', [
            'title' => 'Dashboard',
            'students' => Student::count(),
            'criterias' => Criteria::count(),
            'kelases' => Kelas::count(),
            'users' => User::count(),
        ]);
    }
}

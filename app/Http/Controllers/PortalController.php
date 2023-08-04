<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Kelas;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index(Request $request)
    {

        return view('pages.portal', [
            'students' => Student::count(),
            'criterias' => Criteria::count(),
            'kelases' => Kelas::count(),
            'users' => User::count(),
        ]);
    }
}

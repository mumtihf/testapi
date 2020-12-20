<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CourseController extends Controller
{
    private $response = [
        'message' => null,
        'data' => null
    ];

    public function index()
    {
        $kelas = Course::first();
        //return QrCode::generate($kelas->id);
        return view('home', compact('kelas'));
    }

    public function absen(Request $req)
    {
        $req->validate([
            'course_id' => 'required|numeric'
        ]);

        $absen = new Absen();
        $absen->user_id = Auth::id();
        $absen->course_id = $req->course_id;
        $absen->save();

        $this->response['message'] = 'success';
        return response()->json($this->response, 200);
    }
}

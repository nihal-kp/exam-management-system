<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamResult;

class ExamResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:teacher');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exam_results = ExamResult::with('exam', 'student')->orderBy('id','DESC')->get();
        return view('teacher.exam-result.index')->with(['exam_results'=>$exam_results]);
    }
}
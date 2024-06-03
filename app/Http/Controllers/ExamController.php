<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Models\ExamResult;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::where('status', 1)->get();

        return view('welcome', compact('exams'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return view('exam.show', compact('exam'));
    }

    public function submit(Request $request, Exam $exam)
    {
        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required'
        ]);

        $mark = 0;
        foreach ($exam->examQuestions as $question) {
            if (!empty($request->answers[$question->id])) {
                if ($request->answers[$question->id] == $question->correct_choice) {
                    $mark++;
                }
            }
        }

        $passed = $mark >= $exam->pass_mark ? 1 : 0;

        ExamResult::create([
            'exam_id' => $exam->id,
            'student_id' => auth('student')->id(),
            'mark' => $mark,
            'passed' => $passed
        ]);

        return redirect()->route('exam.result', ['exam' => $exam->id]);
    }

    public function result(Exam $exam)
    {
        $result = ExamResult::where('exam_id', $exam->id)
            ->where('student_id', auth('student')->id())
            ->orderBy('id', 'DESC')->first();

        return view('exam.result', compact('result'));
    }

    public function attended()
    {
        $studentId = auth('student')->id();
        $examResults = ExamResult::where('student_id', $studentId)->with('exam')->get();

        return view('exam.attended', compact('examResults'));
    }
}

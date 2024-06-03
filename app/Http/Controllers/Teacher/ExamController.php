<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Exam;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamQuestion;
use App\Models\ExamResult;

class ExamController extends Controller
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
        $exams = Exam::orderBy('id','DESC')->get();
        return view('teacher.exam.index')->with(['exams'=>$exams]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.exam.form')->with([
            'exam' => new Exam(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'duration' => 'required',
            'pass_mark' => 'required',
            'status'=>'required',
            'question.*' => 'required|string',
            'choice_a.*' => 'required|string',
            'choice_b.*' => 'required|string',
            'choice_c.*' => 'required|string',
            'choice_d.*' => 'required|string',
            'correct_choice.*' => 'required|string',
         ]);

         $exam = Exam::create($request->all());

         //Insert Exam Questions
        if ($request->question != null) {
            $question_arr = $request->question;
            $question_count = count($question_arr);
            for ($i = 0; $i < $question_count; $i++) {
                if ($request->question[$i] != null) {
                    ExamQuestion::create([
                        'exam_id' => $exam->id,
                        'question' => $request->question[$i],
                        'choice_a' => $request->choice_a[$i],
                        'choice_b' => $request->choice_b[$i],
                        'choice_c' => $request->choice_c[$i],
                        'choice_d' => $request->choice_d[$i],
                        'correct_choice' => $request->correct_choice[$i],
                    ]);
                }
            }
        }
		
        return redirect()->route('teacher.exam.index')->with('success message', 'Exam Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        return view('teacher.exam.form')->with([
            'exam' => $exam,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        $this->validate($request, [
            'name' => 'required',
            'duration' => 'required',
            'pass_mark' => 'required',
            'status'=>'required',
            'question.*' => 'required|string',
            'choice_a.*' => 'required|string',
            'choice_b.*' => 'required|string',
            'choice_c.*' => 'required|string',
            'choice_d.*' => 'required|string',
            'correct_choice.*' => 'required|string',
         ]);

         $exam->update($request->all());

         //Update Exam Questions
        $req_question_ids = $request->question_id;
        $question_ids = [];
        if(!empty($req_question_ids)) {
            foreach($req_question_ids as $question_id) {
                if(!empty($question_id)) {
                    $question_ids[] = $question_id;
                }
            }
        }
        
        ExamQuestion::where('exam_id', $exam->id)->whereNotIn('id', $question_ids)->delete();

        if ($request->question != null) {
            $question_arr = $request->question;
            $question_count = count($question_arr);
            for ($i = 0; $i < $question_count; $i++) {
                if ($request->question[$i] != null) {
                    ExamQuestion::updateOrCreate([
                            'id' => $request->question_id[$i],
                        ],[
                            'exam_id' => $exam->id,
                            'question' => $request->question[$i],
                            'choice_a' => $request->choice_a[$i],
                            'choice_b' => $request->choice_b[$i],
                            'choice_c' => $request->choice_c[$i],
                            'choice_d' => $request->choice_d[$i],
                            'correct_choice' => $request->correct_choice[$i],
                        ]);
                }
            }
        }

        return redirect()->route('teacher.exam.index')->with('success message', 'Exam Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $resultCount = ExamResult::where('exam_id', $exam->id)->get()->count();

        if($resultCount > 0) {
            return redirect()->route('teacher.exam.index')->with("failed message", "Can't Delete! Already in use");
        }
        else {
            $exam->examQuestions()->delete();
            $exam->delete();
            return redirect()->route('teacher.exam.index')->with('success message', 'Exam Deleted Successfully!');
        }
        
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Exam;

class ExamQuestion extends Model
{
    protected $fillable = ['name', 'exam_id', 'question', 'choice_a', 'choice_b', 'choice_c', 'choice_d', 'correct_choice'];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}

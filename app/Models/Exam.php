<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamQuestion;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'duration', 'pass_mark', 'status'];

    public function examQuestions()
    {
        return $this->hasMany(ExamQuestion::class, 'exam_id');
    }
}

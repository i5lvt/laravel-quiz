<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\StudentAnswer;

class StudentController extends Controller
{
    public function show()
    {
        $question = Question::inRandomOrder()->first();

        return view('student.show', compact('question'));
    }

    public function record(Request $request)
    {
        StudentAnswer::create([
            'question_id' => $request->question_id,
            'is_correct' => $request->is_correct,
            'visitor_ip' => $request->ip(),
        ]);

        return response()->json(['message' => 'تم الحفظ']);
    }
}

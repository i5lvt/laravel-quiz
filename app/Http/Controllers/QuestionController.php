<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\StudentAnswer;


class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->get();

        // إحصائيات حقيقية من جدول student_answers
        $totalQuestions = $questions->count();
        $correctAnswers = StudentAnswer::where('is_correct', true)->count();
        $wrongAnswers = StudentAnswer::where('is_correct', false)->count();
        $visitors = StudentAnswer::distinct('visitor_ip')->count(); // عدد الزوار حسب IP

        return view('dashboard', compact(
            'questions',
            'totalQuestions',
            'correctAnswers',
            'wrongAnswers',
            'visitors'
        ));
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question_ar' => 'required',
            'question_en' => 'required',
            'options_ar' => 'required|array|size:4',
            'options_en' => 'required|array|size:4',
            'correct_index' => 'required|integer|min:1|max:4', // المستخدم يدخل من 1 إلى 4
            'bg_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            'button_color' => 'nullable|string',
            'video_correct' => 'nullable|file|mimes:mp4,webm,ogg|max:10240',
            'video_wrong' => 'nullable|file|mimes:mp4,webm,ogg|max:10240',
        ]);

        // نحول correct_index إلى 0-based
        $data['correct_index'] -= 1;

        // رفع الفيديوهات
        if ($request->hasFile('video_correct')) {
            $data['video_correct'] = $request->file('video_correct')->store('videos', 'public');
        }

        if ($request->hasFile('video_wrong')) {
            $data['video_wrong'] = $request->file('video_wrong')->store('videos', 'public');
        }

        // تحويل الخيارات إلى JSON
        $data['options_ar'] = json_encode($data['options_ar']);
        $data['options_en'] = json_encode($data['options_en']);

        Question::create($data);

        return redirect()->route('dashboard')->with('success', 'تمت إضافة السؤال بنجاح');
    }


    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $data = $request->validate([
            'question_ar' => 'required',
            'question_en' => 'required',
            'options_ar' => 'required|array|size:4',
            'options_en' => 'required|array|size:4',
            'correct_index' => 'required|integer|min:1|max:4', // المستخدم يدخل من 1 إلى 4
            'bg_color' => 'nullable|string',
            'text_color' => 'nullable|string',
            'button_color' => 'nullable|string',
            'video_correct' => 'nullable|file|mimes:mp4,webm,ogg|max:10240',
            'video_wrong' => 'nullable|file|mimes:mp4,webm,ogg|max:10240',
        ]);

        // نحول correct_index إلى 0-based
        $data['correct_index'] -= 1;

        if ($request->hasFile('video_correct')) {
            $data['video_correct'] = $request->file('video_correct')->store('videos', 'public');
        }

        if ($request->hasFile('video_wrong')) {
            $data['video_wrong'] = $request->file('video_wrong')->store('videos', 'public');
        }

        $data['options_ar'] = json_encode($data['options_ar']);
        $data['options_en'] = json_encode($data['options_en']);

        $question->update($data);

        return redirect()->route('dashboard')->with('success', 'تم تحديث السؤال بنجاح');
    }



    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('dashboard')->with('success', 'تم حذف السؤال');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question_ar',
        'question_en',
        'options_ar',
        'options_en',
        'correct_index',
        'bg_color',
        'text_color',
        'button_color',
        'video_correct',
        'video_wrong',
    ];
}

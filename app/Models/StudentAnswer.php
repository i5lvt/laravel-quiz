<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'question_id',
        'is_correct',
        'visitor_ip',
    ];
}

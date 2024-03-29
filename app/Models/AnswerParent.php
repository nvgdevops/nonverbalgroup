<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerParent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'lesson_id',
        'quiz_id',
        'is_complete',
        'sheet_row'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserSecurityAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'security_question_id', 'answer'];

    // Automatically hash the answer when setting
    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = Hash::make(strtolower(trim($value)));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function securityQuestion()
    {
        return $this->belongsTo(SecurityQuestion::class);
    }

    // Verify answer
    public function verifyAnswer($inputAnswer)
    {
        return Hash::check(strtolower(trim($inputAnswer)), $this->answer);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordHistory extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'password', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if a password exists in history for a user
    public static function passwordExistsInHistory($userId, $password)
    {
        // 1. Check current user password
        $user = \App\Models\User::find($userId);
        if ($user && \Hash::check($password, $user->password)) {
            return true;
        }

        // 2. Check history (Active AND Inactive)
        return self::where('user_id', $userId)
            // ->where('status', 1) // Removed to check ALL history as requested
            ->get()
            ->contains(function ($history) use ($password) {
                return \Hash::check($password, $history->password);
            });
    }

    // Deactivate all previous passwords for a user
    public static function deactivateAllForUser($userId)
    {
        self::where('user_id', $userId)->update(['status' => 0]);
    }

    // Add new password to history
    public static function addToHistory($userId, $password)
    {
        // Deactivate old ones
        self::deactivateAllForUser($userId);

        // Add new one
        self::create([
            'user_id' => $userId, 
            'password' => \Hash::make($password),
            'status' => 1
        ]);
    }
}

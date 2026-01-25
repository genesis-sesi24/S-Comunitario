<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'role',
        'phone',
        'avatar',
        'theme_color',
        'is_active',
        'familia_id',
        'parentesco',
        'cedula',
        'fecha_nacimiento',
        'sexo',
        'escolaridad'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
            'fecha_nacimiento' => 'date',
        ];
    }

    public function familia(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Familia::class);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get formatted role name
     */
    public function getRoleName(): string
    {
        switch($this->role) {
            case 'admin':
                return 'Administrador';
            case 'medico':
                return 'Médico';
            case 'secretaria':
                return 'Secretaria';
            case 'paciente':
                return 'Paciente';
            default:
                return 'Desconocido';
        }
    }

    /**
     * Relationship with UserSecurityAnswer
     */
    public function securityAnswer()
    {
        return $this->hasOne(UserSecurityAnswer::class);
    }

    /**
     * Relationship with PasswordHistory
     */
    public function passwordHistories()
    {
        return $this->hasMany(PasswordHistory::class);
    }

    /**
     * Get avatar URL or default initials
     */
    public function getAvatarUrl(): ?string
    {
        if ($this->avatar && file_exists(public_path($this->avatar))) {
            return asset($this->avatar);
        }
        return null;
    }

    /**
     * Get user initials for avatar placeholder
     */
    public function getInitials(): string
    {
        $nameParts = explode(' ', $this->name);
        if (count($nameParts) >= 2) {
            return strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[1], 0, 1));
        }
        return strtoupper(substr($this->name, 0, 2));
    }

    /**
     * Get theme color or default
     */
    public function getThemeColor(): string
    {
        return $this->theme_color ?? '#0d9488';
    }
}

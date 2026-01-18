<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

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
}

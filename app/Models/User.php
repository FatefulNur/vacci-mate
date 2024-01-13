<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Enums\UserStatus;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'nid',
        'phone',
        'status',
        'vaccine_center_id',
        'password',
        'scheduled_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'status' => UserStatus::class,
        'nid' => 'integer',
        'phone' => 'integer',
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function vaccineCenter(): BelongsTo
    {
        return $this->belongsTo(VaccineCenter::class);
    }

    public function hasBeenVaccinated()
    {
        return ($this->status === UserStatus::SCHEDULED &&
            !is_null($this->scheduled_at) &&
            $this->scheduled_at->diffInHours(now()) >= 12);
    }

    public function canBeVaccinated()
    {
        return ($this->status === UserStatus::NOT_VACCINATED &&
            is_null($this->scheduled_at));
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->email, ['admin@test.com']);
    }
}

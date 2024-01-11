<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nid',
        'phone',
        'status',
        'vaccine_center_id',
        'scheduled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'status' => UserStatus::class,
        'nid' => 'integer',
        'phone' => 'integer',
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
}

<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Models\User;

class UserService
{
    public function getUsersOfVaccineCenter(array $data)
    {
        return User::query()->select('id', 'name', 'email', 'status', 'scheduled_at', 'created_at')
            ->where('vaccine_center_id', $data['vaccine_center_id'])
            ->where('status', $data['status'])
            ->orderBy('created_at')
            ->get();
    }

    public function markAsVaccinated(User $user): void
    {
        $user->update(['status' => UserStatus::VACCINATED]);
    }

    public function markAsScheduled(User $user): void
    {
        $user->update([
            'status' => UserStatus::SCHEDULED,
            'scheduled_at' => now(),
        ]);
    }
}

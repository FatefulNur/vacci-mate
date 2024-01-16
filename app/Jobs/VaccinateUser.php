<?php

namespace App\Jobs;

use App\Enums\UserStatus;
use App\Models\VaccineCenter;
use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class VaccinateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(UserService $userService): void
    {
        $centers = VaccineCenter::select('id', 'name', 'limit')->get();

        foreach ($centers as $center) {
            $scheduledUsers = $userService->getUsersOfVaccineCenter([
                'vaccine_center_id' => $center->id,
                'status' => UserStatus::SCHEDULED,
            ]);

            foreach ($scheduledUsers as $user) {
                if (!$user->hasBeenVaccinated()) {
                    continue;
                }

                $userService->markAsVaccinated($user);
            }
        }
    }
}

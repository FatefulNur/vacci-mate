<?php

namespace App\Jobs;

use App\Enums\UserStatus;
use App\Models\VaccineCenter;
use App\Notifications\UserScheduled;
use App\Services\UserService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessVaccination implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
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

            $notVaccinatedUsers = $userService->getUsersOfVaccineCenter([
                'vaccine_center_id' => $center->id,
                'status' => UserStatus::NOT_VACCINATED,
            ])->take($center->limit);

            foreach ($notVaccinatedUsers as $user) {
                if (!$user->canBeVaccinated()) {
                    continue;
                }

                $userService->markAsScheduled($user);

                $user->notify(new UserScheduled($user));
            }
        }
    }
}

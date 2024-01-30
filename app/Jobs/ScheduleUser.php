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

class ScheduleUser implements ShouldQueue
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
            $notVaccinatedUsers = $userService->getUsersOfVaccineCenter([
                'vaccine_center_id' => $center->id,
                'status' => UserStatus::NOT_VACCINATED,
            ])->take($center->limit);

            foreach ($notVaccinatedUsers as $user) {
                if (!$user->canBeVaccinated()) {
                    continue;
                }

                NotifyUser::dispatch($user);
            }
        }
    }
}

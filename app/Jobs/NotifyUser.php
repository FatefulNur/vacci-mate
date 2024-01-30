<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Bus\Queueable;
use App\Notifications\UserScheduled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NotifyUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(UserService $userService): void
    {
        $userService->markAsScheduled($this->user);

        $this->user->notify(new UserScheduled($this->user));
    }
}

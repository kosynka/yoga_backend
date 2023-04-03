<?php

namespace App\Jobs;

use App\Events\UserPackageExpired;
use App\Repositories\Contracts\DeleteUsersExpiredPackageJobInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeleteUsersExpiredPackageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private DeleteUsersExpiredPackageJobInterface $repository;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DeleteUsersExpiredPackageJobInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->repository->getAll();
        $now = date("Y-m-d");
        $userIds = array();

        foreach ($users as $user) {
            $expireDate = date('Y-m-d', strtotime($user->expires_at));

            if ($expireDate < $now) {
                array_push($userIds, $user->id);

                UserPackageExpired::dispatch($user);

                Log::info('User #' . $user->id . ' package has been expired at date: ' . $now);
            }
        }

        $data = [
            'package_id' => null,
            'expires_at' => null,
            'visits_left' => null,
        ];

        $this->repository->updateAll($userIds, $data);
    }
}

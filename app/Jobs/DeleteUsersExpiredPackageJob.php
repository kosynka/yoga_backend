<?php

namespace App\Jobs;

use App\Events\UserPackageExpired;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeleteUsersExpiredPackageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $users = User::where('role', User::ROLE_USER)->get();
        $now = date("Y-m-d");
        $userIds = array();

        foreach ($users as $user) {
            $expireDate = date('Y-m-d', strtotime($user->expires_at));

            if ($expireDate < $now) {
                array_push($userIds, $user->id);

                UserPackageExpired::dispatch($user);

                Log::info('User #' . $user->id . ' package has been expired at ' . $now);
            }
        }

        $data = [
            'package_id' => null,
            'expires_at' => null,
            'visits_left' => null,
        ];

        User::whereIn('id', $userIds)->update($data);
    }
}

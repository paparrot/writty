<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ClearNotVerifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-not-verified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear not verified users after 48 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::whereNull('email_verified_at')
            ->where('created_at', '<', now()->subWeek())
            ->forceDelete();
    }
}

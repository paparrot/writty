<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class DeleteUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete user by id.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        $user = User::find($id);

        $user->posts()->forceDelete();
        $user->forceDelete();

        $this->info("User deleted.");
    }
}

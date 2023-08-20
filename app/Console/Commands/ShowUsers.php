<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ShowUsers extends Command
{
    private const PER_PAGE = 20;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list {--page=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show user list.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $page = (int) $this->option('page');
        $users = User::latest()->paginate(perPage: self::PER_PAGE, page: $page)
            ->getCollection()
            ->map(fn (User $user) => [
                'id' => $user->id,
                'name' => $user->name,
                'nickname' => $user->nickname
            ]);

        $this->table(['ID', 'Name', 'Nickname'], $users->toArray());
    }
}

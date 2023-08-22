<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DeletePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:delete {id?*} {--author=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete posts.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ids = $this->argument('id');

        if ($this->option('author')) {
            $authorId = $this->option('author');

            if (! Str::isUuid($authorId)) {
                $this->error("Author is not UUID.");

                return Command::FAILURE;
            }

            if (!empty($ids)) {
                $this->error("Author should use without ids arguments.");

                return Command::FAILURE;
            }

            $ids = Post::where('author_id', $authorId)->pluck('id');
        }


        DB::beginTransaction();

        foreach ($ids as $id) {
            if (!Str::isUuid($id)) {
                $this->newLine();
                $this->error("NOT UUID: $id");
                DB::rollBack();

                return Command::FAILURE;
            }

            $post = Post::find($id);

            if (!$post) {
                DB::rollBack();
                $this->newLine();
                $this->error("NOT FOUND: $id");

                continue;
            }

            $this->newLine();
            $this->info("POST ADDED TO DELETION: $id");
            $post->delete();
        }

        DB::commit();
        $this->info("ALL POSTS DELETED");

        return Command::SUCCESS;
    }
}

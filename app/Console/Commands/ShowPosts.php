<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ShowPosts extends Command
{
    private const PER_PAGE = 20;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:list {--page=1} {--search=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show post list.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $page = (int)$this->option('page');
        $offset = ($page - 1) * self::PER_PAGE;

        if ($this->option('search')) {
            $posts = Post::search($this->option('search'))
                ->paginate(
                    perPage: self::PER_PAGE,
                    page: $page
                );
        } else {
            $posts = Post::limit(self::PER_PAGE)
                ->offset($offset)
                ->latest()
                ->get();
        }

           $result =  $posts->map(fn(Post $post) => [
                'id' => $post->id,
                'content' => Str::limit($post->content, 70),
                'author_id' => $post->author_id,
                'author_nickname' => $post->author?->nickname,
                'created_at' => $post->created_at
            ])
            ->all();

        $this->table(['ID', 'Content', 'Author ID', 'Author nickname'], $result);
    }
}

<?php

namespace Tests\Feature\BaseTests;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Inertia\Testing\AssertableInertia;

class PostBaseTest extends BaseTest
{
    use RefreshDatabase;

    protected int $count;

    protected Collection $posts;
    protected const DEFAULT_PAGINATION = 15;

    public function setUp(): void
    {
        parent::setUp();
        $this->count = rand(1, 30);
        $this->posts = Post::factory()->count($this->count)->create();
    }

    protected function comparePostFields(AssertableInertia $page): AssertableInertia
    {
        return $page
            ->has('id')
            ->has('reposted')
            ->has('repliesCount')
            ->has('isLiked')
            ->has('author', fn(AssertableInertia $page) => $page
                ->has('nickname')
                ->has('id')
                ->has('avatar')
                ->has('name')
            )
            ->has('likesCount')
            ->has('created')
            ->has('attachment')
            ->has('content');
    }
}

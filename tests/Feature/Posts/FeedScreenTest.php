<?php

namespace Tests\Feature\Posts;

use App\Models\Post;
use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class FeedScreenTest extends PostBaseTest
{

    /**
     * A basic feature test example.
     */
    public function test_feed(): void
    {
        $count = min($this->count, self::DEFAULT_PAGINATION);
        $restCount = $this->count - $count;

        $this->get(route('home'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(
                fn(AssertableInertia $page) => $page
                    ->component('Feed',)
                    ->has('posts.data', $count)
                    ->has('posts.data.0', fn(AssertableInertia $prop) => $this->comparePostFields($prop))
                    ->has('posts.meta.current_page')
                    ->has('posts.meta.last_page')
            );

        if ($restCount) {
            $this->get(route('home', ['page' => 2]))
                ->assertStatus(BaseResponse::HTTP_OK)
                ->assertInertia(
                    fn(AssertableInertia $page) => $page
                        ->component('Feed')
                        ->has('posts.data', $restCount)
                        ->where('posts.meta.current_page', 2)
                        ->where('posts.meta.last_page', 2)
                );
        }
    }

    public function test_feed_without_posts(): void
    {
        $this->posts->each(fn(Post $post) => $post->delete());

        $this->get(route('home'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Feed')
                ->has('posts.data', 0)
            );
    }

    public function test_first_post_is_latest(): void
    {
        sleep(2);

        $post = Post::factory()->create();

        $this->get(route('home'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->has('posts.data')
                ->has('posts.data.0', fn(AssertableInertia $prop) => $this->comparePostFields($prop))
                ->where('posts.data.0.id', $post->id)
            );
    }
}

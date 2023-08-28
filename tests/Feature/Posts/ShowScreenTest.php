<?php

namespace Tests\Feature\Posts;

use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class ShowScreenTest extends PostBaseTest
{
    use WithFaker;

    /**
     * A basic feature test example.
     */
    public function test_post_not_exists(): void
    {
        $id = $this->faker->unique()->uuid;

        $this->get(route('posts.show', ['post' => $id]))
            ->assertStatus(BaseResponse::HTTP_NOT_FOUND);
    }

    public function test_post(): void
    {
        $post = $this->posts->random();

        $this->get(route('posts.show', ['post' => $post->id]))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Post/Show')
                ->has('post', fn(AssertableInertia $prop) => $this->comparePostFields($prop))
                ->has('replies.data', 0)
            );
    }

    public function test_post_with_replies()
    {
        $post = $this->posts->random();
        Post::factory(['replied_id' => $post->id])->create();

        $this->get(route('posts.show', ['post' => $post->id]))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Post/Show')
                ->has('post')
                ->has('replies.data', 1)
                ->has('replies.data.0', fn(AssertableInertia $prop) => $this->comparePostFields($prop))
            );
    }
}

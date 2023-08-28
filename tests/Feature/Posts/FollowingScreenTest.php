<?php

namespace Tests\Feature\Posts;

use App\Models\Post;
use App\Models\User;
use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class FollowingScreenTest extends PostBaseTest
{
    /**
     * A basic feature test example.
     */
    public function test_following_screen_without_auth(): void
    {
        $this->get(route('posts.following'))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_following_screen_without_posts(): void
    {
        $this->asFakeUser();

        $this->get(route('posts.following'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->has('posts.data', 0)
            );
    }

    public function test_following_screen(): void
    {
        $this->asFakeUser();
        $followingUser = User::factory()->create();
        $post = Post::factory(['author_id' => $followingUser->id])->create();
        $this->currentUser->follow($followingUser);

        $this->get(route('posts.following'))
            ->assertStatus(BaseResponse::HTTP_OK)
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Post/Following')
                ->has('posts.data', 1)
                ->has('posts.data.0', fn(AssertableInertia $prop) => $this->comparePostFields($prop))
                ->where('posts.data.0.id', $post->id)
            );
    }
}

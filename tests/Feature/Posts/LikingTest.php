<?php

namespace Tests\Feature\Posts;

use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class LikingTest extends PostBaseTest
{
    use WithFaker;

    public function test_like_post_without_auth(): void
    {
        $post = $this->posts->random();
        $this->post(route('posts.like', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_like_post_without_verifying(): void
    {
        $this->asFakeUser(['email_verified_at' => null]);
        $post = $this->posts->random();
        $this->post(route('posts.like', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('verification.notice');
    }

    public function test_like_post(): void
    {
        $this->asFakeUser();
        $post = $this->posts->random();
        $this
            ->from(route('home'))
            ->post(route('posts.like', ['post' => $post]))
            ->assertRedirectToRoute('home');

        $this->assertDatabaseHas('likes', [
            'user_id' => $this->currentUser->id,
            'likeable_type' => Post::class,
            'likeable_id' => $post->id,
        ]);
    }

    public function test_like_undefined_post(): void
    {
        $this->asFakeUser();
        $post = $this->faker->uuid();

        $this->from(route('home'))
            ->post(route('posts.like', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_NOT_FOUND);
    }

    public function test_like_liked_post(): void
    {
        $this->asFakeUser();
        $post = $this->posts->random();
        $this->currentUser->like($post);

        $this->assertDatabaseCount('likes', 1);

        $this->from(route('home'))
            ->post(route('posts.like', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('home');

        $this->assertDatabaseCount('likes', 1);
    }

    public function test_unlike_post_without_auth(): void
    {
        $post = $this->posts->random();
        $this->post(route('posts.unlike', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_unlike_post_without_verified(): void
    {
        $this->asFakeUser(['email_verified_at' => null]);
        $post = $this->posts->random();
        $this->post(route('posts.unlike', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('verification.notice');
    }

    public function test_unlike_post(): void
    {
        $this->asFakeUser();
        $post = $this->posts->random();
        $this->currentUser->like($post);

        $this
            ->from(route('home'))
            ->delete(route('posts.unlike', ['post' => $post]))
            ->assertRedirectToRoute('home');

        $this->assertDatabaseMissing('likes', [
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
            'user_id' => $this->currentUser->id,
        ]);
    }

    public function test_unlike_unliked_post(): void
    {
        $this->asFakeUser();
        $post = $this->posts->random();

        $this->assertDatabaseMissing('likes', [
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
            'user_id' => $this->currentUser->id,
        ]);

        $this
            ->from(route('home'))
            ->delete(route('posts.unlike', ['post' => $post]))
            ->assertRedirectToRoute('home');

        $this->assertDatabaseMissing('likes', [
            'likeable_id' => $post->id,
            'likeable_type' => Post::class,
            'user_id' => $this->currentUser->id,
        ]);
    }
}

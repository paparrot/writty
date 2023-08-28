<?php

namespace Tests\Feature\Posts;

use App\Events\PostDeleted;
use App\Models\Post;
use Illuminate\Support\Facades\Event;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class DeletingTest extends PostBaseTest
{
    public function test_delete_post_without_auth(): void
    {
        $post = $this->posts->random();
        $this->delete(route('posts.delete', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_delete_post_other_author(): void
    {
        $this->asFakeUser();

        $post = $this->posts->random();

        $this
            ->from(route('posts.following'))
            ->delete(route('posts.delete', ['post' => $post]))
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('posts.following');

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);
    }

    public function test_delete_post_when_not_verified(): void
    {
        $this->asFakeUser(['email_verified_at' => null]);

        $post = Post::factory(['author_id' => $this->currentUser->id])->create();

        $this
            ->from(route('home'))
            ->delete(route('posts.delete', ['post' => $post]))
                ->assertRedirectToRoute('verification.notice');

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);
    }

    public function test_delete_post(): void
    {
        Event::fake();
        $this->asFakeUser();

        $post = Post::factory(['author_id' => $this->currentUser->id])->create();

        $this
            ->from(route('home'))
            ->delete(route('posts.delete', ['post' => $post]))
            ->assertRedirectToRoute('home');

        Event::assertDispatched(PostDeleted::class);

        $this->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
    }
}

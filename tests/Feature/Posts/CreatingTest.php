<?php

namespace Tests\Feature\Posts;

use App\Events\PostCreated;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Event;
use Inertia\Testing\AssertableInertia;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use Tests\Feature\BaseTests\PostBaseTest;

class CreatingTest extends PostBaseTest
{
    use WithFaker;

    public function test_create_without_auth(): void
    {
        $this->post(route('posts.store'), [
            'content' => ''
        ])
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('login');
    }

    public function test_create_without_verification(): void
    {
        $this->asFakeUser(['email_verified_at' => null]);

        $this->post(route('posts.store'), [
            'content' => ''
        ])
            ->assertStatus(BaseResponse::HTTP_FOUND)
            ->assertRedirectToRoute('verification.notice');
    }

    public function test_create_with_invalid_data(): void
    {
        $this->asFakeUser(['email_verified_at' => now()]);

        $this
            ->followingRedirects()
            ->post(route('posts.store'))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->has('errors.content')
            );
    }

    public function test_create_with_attachment_without_content(): void
    {
        $this->asFakeUser();
        $attachment = UploadedFile::fake()->image('test_image.jpg');

        $this
            ->followingRedirects()
            ->post(route('posts.store'), [
                'attachment' => $attachment,
            ])
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->has('errors.content')
            );

        $this->assertDatabaseMissing('posts', [
            'author_id' => $this->currentUser->id
        ]);
    }

    public function test_create_with_content(): void
    {
        Event::fake();
        $this->asFakeUser(['email_verified_at' => now()]);
        $content = $this->faker->text(255);
        $attachment = UploadedFile::fake()->image('test_image.jpg');

        $this
            ->followingRedirects()
            ->post(route('posts.store'), [
                'content' => $content,
                'attachment' => $attachment,
            ])
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component("Feed")
                ->missing('errors.*')
            );

        Event::assertDispatched(PostCreated::class);

        $this->assertDatabaseHas('posts', [
            'content' => $content,
            'author_id' => $this->currentUser->id,
        ]);
    }

    public function test_create_reply_without_content(): void
    {
        $this->asFakeUser(['email_verified_at' => now()]);
        $replied = $this->posts->random();

        $this
            ->followingRedirects()
            ->post(route('posts.reply', ['post' => $replied]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->has('errors.content')
            );

        $this->assertDatabaseMissing('posts', [
            'replied_id' => $replied->id,
        ]);
    }

    public function test_create_reply(): void
    {
        $this->asFakeUser(['email_verified_at' => now()]);
        $replied = $this->posts->random();
        $content = $this->faker->text(255);

        $this
            ->followingRedirects()
            ->post(route('posts.reply', ['post' => $replied]), [
                'content' => $content
            ])
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Post/Show')
                ->has('post')
                ->where('post.id', $replied->id)
                ->has('replies.data', 1)
                ->where('replies.data.0.content', $content)
                ->missing('errors.content')
                ->missing('errors.attachment')
            );

        $this->assertDatabaseHas('posts', [
            'replied_id' => $replied->id,
            'content' => $content,
            'author_id' => $this->currentUser->id
        ]);
    }

    public function test_create_repost(): void
    {
        $this->asFakeUser(['email_verified_at' => now()]);
        $reposted = $this->posts->random();

        $this
            ->followingRedirects()
            ->post(route('posts.repost', ['post' => $reposted]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->component('Feed')
                ->has('posts.data')
            );

        $this->assertDatabaseHas('posts', [
            'reposted_id' => $reposted->id,
            'author_id' => $this->currentUser->id,
            'content' => null,
        ]);
    }
}

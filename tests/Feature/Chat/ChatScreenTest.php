<?php

namespace Tests\Feature\Chat;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\Feature\BaseTests\BaseTest;

class ChatScreenTest extends BaseTest
{
    use RefreshDatabase;

    private User $recipient;

    public function setUp(): void
    {
        parent::setUp();
        $this->recipient = User::factory()->create();
    }

    public function test_chat_screen_without_auth(): void
    {
        $this->get(route('chat.show', ['user' => $this->recipient]))
            ->assertRedirectToRoute('login');
    }

    public function test_chat_screen_without_verification_email(): void
    {
        $this->asFakeUser(['email_verified_at' => null]);

        $this->get(route('chat.show', ['user' => $this->recipient]))
            ->assertOk();
    }

    public function test_chat_screen(): void
    {
        $this->asFakeUser();

        $this->get(route('chat.show', ['user' => $this->recipient]))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page): AssertableInertia => $page
                ->component('Chat')
                ->has('user', fn(AssertableInertia $prop): AssertableInertia => $prop
                    ->where('id', $this->recipient->id)
                    ->where('name', $this->recipient->name)
                    ->where('nickname', $this->recipient->nickname)
                    ->where('avatar', $this->recipient->profile_photo_path)
                )
            );
    }

    public function test_chat_with_messages(): void
    {
        $this->asFakeUser();

        $messages = Message::factory(['user_from' => $this->currentUser->id, 'user_to' => $this->recipient->id])
            ->count(rand(1, 20))
            ->create();

        $this->get(route('chat.show', ['user' => $this->recipient]))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Chat')
                ->has('messages.data', $messages->count())
            );
    }

    public function test_chat_doesnt_have_excess_messages(): void
    {
        $this->asFakeUser();
        Message::factory(['user_from' => $this->currentUser->id, 'user_to' => $this->recipient->id])
            ->create();
        Message::factory()->create();

        $this->get(route('chat.show', ['user' => $this->recipient]))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $page): AssertableInertia => $page
                ->component('Chat')
                ->has('messages.data', 1)
            );
    }
}

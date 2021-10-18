<?php

namespace Tests\Feature\User\Settings;

use App\Http\Livewire\User\DeleteAccount;
use App\Http\Livewire\User\Profile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    /** @test */
    function user_can_add_an_avatar()
    {
        Storage::fake('public');

        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $this->assertNull($user->avatar);

        Livewire::test(Profile::class)
            ->set('username', $user->username)
            ->set('email', $user->email)
            ->set('country', $user->country)
            ->set('avatar', UploadedFile::fake()->image('new.png'))
            ->call('submit');

        $user->refresh();

        $this->assertNotNull($user->avatar);
        Storage::disk('public')->assertExists($user->avatar);
    }

    /** @test */
    function user_can_remove_own_avatar()
    {
        Storage::fake('public');

        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        Livewire::test(Profile::class)
            ->set('username', $user->username)
            ->set('email', $user->email)
            ->set('country', $user->country)
            ->set('avatar', UploadedFile::fake()->image('new.png'))
            ->call('submit');

        $user->refresh();

        $filePath = $user->avatar;

        $this->assertNotNull($filePath);
        Storage::disk('public')->assertExists($filePath);

        Livewire::test(Profile::class)
            ->call('removeAvatar');

        $user->refresh();

        $this->assertNull($user->avatar);
        Storage::disk('public')->assertMissing($filePath);
    }

    /** @test */
    function previous_avatar_file_is_removed_when_user_select_another_one()
    {
        Storage::fake('public');

        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        Livewire::test(Profile::class)
            ->set('username', $user->username)
            ->set('email', $user->email)
            ->set('country', $user->country)
            ->set('avatar', UploadedFile::fake()->image('old.png'))
            ->call('submit');

        $user->refresh();

        $filePath = $user->avatar;

        Storage::disk('public')->assertExists($filePath);

        Livewire::test(Profile::class)
            ->set('username', $user->username)
            ->set('email', $user->email)
            ->set('country', $user->country)
            ->set('avatar', UploadedFile::fake()->image('new.png'))
            ->call('submit');

        $user->refresh();

        Storage::disk('public')->assertMissing($filePath);
        Storage::disk('public')->assertExists($user->avatar);
    }

    /** @test */
    function avatar_file_is_removed_when_the_user_deletes_his_account()
    {
        Storage::fake('public');

        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        Livewire::test(Profile::class)
            ->set('username', $user->username)
            ->set('email', $user->email)
            ->set('country', $user->country)
            ->set('avatar', UploadedFile::fake()->image('avatar.png'))
            ->call('submit');

        $user->refresh();

        $filePath = $user->avatar;

        Storage::disk('public')->assertExists($filePath);

        Livewire::test(DeleteAccount::class)
            ->set('email', $user->email)
            ->set('phrase', 'delete my account right now')
            ->call('submit');

        Storage::disk('public')->assertMissing($filePath);
    }
}

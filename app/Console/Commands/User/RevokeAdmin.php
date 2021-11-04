<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class RevokeAdmin extends Command
{
    protected $signature = 'user:revoke-admin {email}';
    protected $description = 'Revoke admin\'s rights from the user';

    public function handle()
    {
        $email = $this->argument('email');

        /** @var User $user */
        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);

            return false;
        }

        try {
            $user->revokeAdminRights();
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return false;
        }

        $this->info("\nAdmin's rights have been revoked.\n");

        return Command::SUCCESS;
    }
}

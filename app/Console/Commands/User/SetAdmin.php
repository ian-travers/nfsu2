<?php

namespace App\Console\Commands\User;

use App\Models\User;
use Illuminate\Console\Command;

class SetAdmin extends Command
{
    protected $signature = 'user:set-admin {email}';
    protected $description = 'Set admin\'s rights to the user';

    public function handle()
    {
        $email = $this->argument('email');

        /** @var User $user */
        if (!$user = User::where('email', $email)->first()) {
            $this->error('Undefined user with email ' . $email);

            return false;
        }

        try {
            $user->setAdminRights();
        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return false;
        }

        $this->info("\nAdmin's rights have been assigned.\n");

        return Command::SUCCESS;
    }
}

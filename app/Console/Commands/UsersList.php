<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class UsersList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Visualizza tutti gli utenti';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** @var Collection $users */
        $users = User::orderBy('usernm')
            ->get();

        $this->table(['Username', 'Ultimo accesso'],
            $users->map(function (User $user) {
                return [
                    $user->usernm,
                    $user->users_log()
                        ->first()
                        ?->latestLoginVerbose(),
                ];
            })
        );
    }
}

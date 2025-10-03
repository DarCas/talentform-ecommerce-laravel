<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsersCreate extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Con questo comando creiamo un utente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->clear();

        $usernm = $this->ask('Inserisci il nome utente (e-mail)');
        $passwd = $this->secret('Inserisci la password (minimo 6 caratteri)');
        $passwd_confirmation = $this->secret('Conferma la password inserita');

        $validator = Validator::make([
            'usernm' => $usernm,
            'passwd' => $passwd,
            'passwd_confirmation' => $passwd_confirmation,
        ], [
            'usernm' => [
                'required',
                'email:rfc',
                Rule::unique('users', 'usernm'),
            ],
            'passwd' => [
                'required',
                'string',
                'min:6',
                'confirmed',    // Verifica la corrispondenza della password con la conferma
            ]
        ]);

        if ($validator->fails()) {
            $fields = [
                'usernm' => 'Nome utente',
                'passwd' => 'Password',
            ];

            $errors = array_reduce($validator->errors()->keys(), function ($carry, $key) use ($validator) {
                $carry[$key] = $validator->errors()->get($key)[0];

                return $carry;
            }, []);

            $this->error("Errore nell'inserimento dei dati:");

            foreach ($errors as $key => $error) {
                $this->error("- {$fields[$key]}: {$error}");
            }

            $this->info('');

            return Command::FAILURE;
        }

        try {
            $user = new User();
            $user->usernm = $validator->getValue('usernm');
            $user->passwd = sha1($validator->getValue('passwd'));
            $user->save();

            $this->info("Utente «{$usernm}» aggiunto");

            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return Command::FAILURE;
        }
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Email;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a user ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user['name'] = $this->ask('Name of the user');
        $user['email'] = $this->ask('Email of the user');
        $plainPass = $this->secret('Password of the user');
        $user['password'] = Hash::make($plainPass);
        $role_name = $this->choice("What is the role of the user?",['admin','editor'],1);
        $role = Role::where('name',$role_name)->first();
        if (! $role){
            $this->info('This role does not exist');
            return -1;
        }
        DB::transaction(function () use ($user,$role) {
            $user =  User::create($user);
            $user->roles()->attach($role->id);
        });
        $this->info('User '. $user['email'] . ' created successfuly');

        return 0;
        
    }
}

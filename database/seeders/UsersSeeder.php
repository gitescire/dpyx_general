<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Cristian',
            'phone' => '5512328187',
            'email' => 'cguzman@ibsaweb.com',
            'password' => bcrypt('¡MyP4ssw0rd!')
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Nydia Lopez',
            'phone' => null,
            'email' => 'nlopez@escire.mx',
            'password' => bcrypt('1Aprender3948.')
        ]);

        $user->assignRole('admin');
    }
}

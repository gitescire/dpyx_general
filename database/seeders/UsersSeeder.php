<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Evaluation;
use App\Models\Question;
use App\Models\Repository;
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
            'name' => 'Omar',
            'phone' => null,
            'email' => 'ovilla@ibsaweb.com',
            'password' => bcrypt('Pruebas123')
        ])->assignRole('admin');

        $user = User::create([
            'name' => 'Nydia Lopez',
            'phone' => null,
            'email' => 'nlopez@escire.mx',
            'password' => bcrypt('1Aprender3948.')
        ])->assignRole('admin');
        
        $userEvaluator = User::create([
            'name' => 'Nydia Evaluador',
            'phone' => null,
            'email' => 'valni.info@gmail.com',
            'password' => bcrypt('1Aprender3948.')
        ])->assignRole('evaluador');

        $user = User::create([
            'name' => 'Nydia Repositorio',
            'phone' => null,
            'email' => 'vallei__oswal@hotmail.com',
            'password' => bcrypt('1Aprender3948.')
        ])->assignRole('usuario');

        $repository = Repository::create([
            'responsible_id' => $user->id,
            'name' =>'escire',
            'status' => 'en progreso',
        ]);

        $evaluation = Evaluation::create([
            'repository_id' => $repository->id,
            'evaluator_id' => $userEvaluator->id,
            'status' => 'en progreso',
        ]);

        // Create empty answers for each question
        Question::get()->each(function ($question) use ($evaluation) {
            Answer::create([
                'evaluation_id' => $evaluation->id,
                'question_id' => $question->id
            ]);
        });
        

    }
}

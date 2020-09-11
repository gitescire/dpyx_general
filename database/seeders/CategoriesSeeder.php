<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Interacción con los lectores'],
            ['name' => 'Visibilidad'],
            ['name' => 'Hardware'],
            ['name' => 'Software'],
            ['name' => 'Formatos abiertos'],
            ['name' => 'Preservación digital'],
            ['name' => 'Políticas de gobernanza'],
            ['name' => 'Mantenimiento y desarrollo de políticas'],
        ]);
    }
}

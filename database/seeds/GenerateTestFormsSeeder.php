<?php

use Illuminate\Database\Seeder;

class GenerateTestFormsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Form::class, 50)->create();
    }
}

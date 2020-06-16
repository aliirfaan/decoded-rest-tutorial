<?php

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = array(
            ['name' => 'Sudan', 'country' => 'Arabic'],
            ['name' => 'Somalia', 'country' => 'Somali'],
            ['name' => 'South Africa', 'country' => 'Sesotho']
        );

        foreach($seeds as $seed) {
            Language::create([
                'name' => $seed['name'],
                'country' => $seed['country'],
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\oferta\Protocolo;

class ProtocolosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        foreach (range(1,50) as $index) {
        $data = [
        'id' => $faker->id,
        'txt_protocolo' => $faker->unique()->txt_protocolo,
        ];
        Protocolo::create($data);
        }
    }
}

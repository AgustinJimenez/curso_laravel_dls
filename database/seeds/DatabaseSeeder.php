<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Modelos\Cliente;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker::create();

        for($i = 0; $i<=10000; $i++)
        {
            Cliente::create
            ([
                'razon_social' => $faker->name,
                'fecha_nacimiento' => $faker->date('d/m/Y', 'now'),
                'direccion' => $faker->streetAddress,
                'comentario' => $faker->text(200),
                'ruc' => $faker->numberBetween(100000, 999999),
                'activo' => $faker->boolean
            ]);
        }

    }
}

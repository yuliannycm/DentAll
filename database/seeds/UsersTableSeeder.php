<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            // Begin a transaction
            DB::beginTransaction();

            DB::table('usuarios')->insert([
            	'cedula'       => 23954745,
                'nombre'       => 'Eduar',
                'apellido'     => 'Bastidas',
                'email'        => 'eduarbastidas10@gmail.com',
                'password'     => bcrypt('secreto'),
                'telefono'     => '04160253340',
                'cargo'        => 'DOCTOR',
            ]);

            for ($i = 0; $i < 5; $i++) {
                $faker = Faker::create('es_PE');
                DB::table('pacientes')->insert([
                'nombre'       => $faker->firstName,
                'apellido'     => $faker->lastName,
                'cedula'       => $faker->unique()->randomNumber($nbDigits = 8),
                'email'        => $faker->email,
                'telefono'     => $faker->phoneNumber,
                'direccion'    => $faker->address,
                'tipo_consulta' => $faker->randomElement(['NORMAL' ,'EMERGENCIA']),
            ]);
            }

            // Commit the transaction
            DB::commit();
        } catch (\Exception $e) {
            // An error occured; cancel the transaction...
            DB::rollback();

            // and throw the error again.
            throw $e;
        }
    }
}

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
                'nombres'       => 'Eduar',
                'apellidos'     => 'Bastidas',
                'email'        => 'eduarbastidas10@gmail.com',
                'password'     => bcrypt('secret'),
                'telefono'     => '04165555555',
                'cargo'        => 'DOCTOR',
            ]);

            $faker = Faker::create('es_PE');
            for ($i = 0; $i < 5; $i++) {
                
                DB::table('pacientes')->insert([
                'nombres'       => $faker->firstName,
                'apellidos'     => $faker->lastName,
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

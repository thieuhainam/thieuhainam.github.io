<?php

namespace Modules\Staff\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;
class StaffDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");

        $faker = Faker\Factory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('staff')->insert([
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'created_at' => $faker->phoneNumber,
                'is_active' => $faker->numberBetween($min=0, $max=1)
            ]);
        }
    }
}

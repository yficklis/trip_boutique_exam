<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        DB::table('agency')->insert([
            ['id' => 1, 'name' => 'The Trip Boutique', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Horizon', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Dreams', 'created_at' => now(), 'updated_at' => now()]
        ]);

        DB::table('clients')->insert([
            ['id' => 1, 'name' => 'Boutique', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Forza', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Sandman', 'created_at' => now(), 'updated_at' => now()]
        ]);

        DB::table('agency_clients')->insert([
            ['agency_id' => 1, 'client_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['agency_id' => 2, 'client_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['agency_id' => 3, 'client_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        ]);

        DB::table('hotels')->insert([
            [
                'id' => 1,
                'name' => 'Hotel Seaside',
                'description' => 'A luxurious beachfront getaway offering serene views and top-notch amenities',
                'description_license' => 'by The Trip Boutique',
                'address' => '123 Coastal Ave, Sunnytown',
                'rating' => 4,
                'facilities' => json_encode(['Spa', 'Gym', 'Pool', 'Restaurant', 'Free', 'Wi-FI']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => null,
                'description' => 'Enjoy exclusive access to our private beach and rooftop dining at Hotel Seaside.',
                'description_license' => 'Unset',
                'address' => null,
                'rating' => 4.5,
                'facilities' => json_encode(['Private Beach', 'Rooftop Dining', 'Spa', 'Pool']),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Hotel Seaside Retreat',
                'description' => null,
                'description_license' => null,
                'address' => null,
                'rating' => 4.2,
                'facilities' => json_encode(['Adventure Tours', 'Spa', 'Heated Pool', 'Exclusive Lounge']),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);

        DB::table('agency_hotels')->insert([
            ['agency_id' => 1, 'hotel_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['agency_id' => 2, 'hotel_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['agency_id' => 3, 'hotel_id' => 3, 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}

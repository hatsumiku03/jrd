<?php

namespace Database\Seeders;

use App\Models\Crew;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // | Crews | //
        Crew::factory()->create([
            'name' => 'Los Babus',
            'logo' => null,
            'capacity_people' => 666,
            'slogan' => 'Te voy a coger fill d',
            'color' => '',
            'foundation_date' => '1952/12/25' // Format: YYYY/MM/DD

        ]);

        Crew::factory()->create([
            'name' => 'E S E N C I A',
            'logo' => null,
            'capacity_people' => 34,
            'slogan' => 'Nos arrollidaremos ante el general tablos',
            'color' => '',
            'foundation_date' => '1952/12/25'

        ]);

        Crew::factory()->create([
            'name' => 'XICS',
            'logo' => null,
            'capacity_people' => 23,
            'slogan' => 'ANEM A GUANYAR',
            'color' => '',
            'foundation_date' => '2013/4/3'

        ]);

        Crew::factory(20)->create();

        // | Roles | //

        $admin = Role::factory()->create([
            'name' => 'Admin'
        ]);

        $regular = Role::factory()->create([
            'name' => 'Regular'
        ]);

        
        // | Users | //
        User::factory()->create([
            'name' => 'Mr Babu',
            'profile_photo_path' => 'profile-photos/dfo1hXU4h5YYVZD0Hsna8w7zzkWN1ndq1x0JTs4p.png',
            'email' => 'a@a.a',
            'role_id' => $admin->id,
            'password' => 'a'
            ]);
            
        User::factory()->create([
            'name' => 'Martiluski07',
            'email' => 'e@e.e',
            'profile_photo_path' => 'profile-photos/jH0MkUiE0vyBbEtzZBdMt09HcbMokJqdUUiDN8dC.jpg',
            'role_id' => $regular->id,
            'password' => 'e'
            ]);
        
         User::factory(20)->create(); // Normal users creation
    }
}

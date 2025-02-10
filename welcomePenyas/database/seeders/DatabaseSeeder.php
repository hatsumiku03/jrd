<?php

namespace Database\Seeders;

use App\Models\Crew;
use App\Models\Role;
use App\Models\User;
use App\Models\UserCrew;
use Database\Factories\UserFactory;
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
            'color' => null,
            'foundation_date' => '1952/12/25' // Format: YYYY/MM/DD

        ]);

        Crew::factory()->create([
            'name' => 'E S E N C I A',
            'logo' => null,
            'capacity_people' => 34,
            'slogan' => 'Nos arrollidaremos ante el general tablos',
            'color' => null,
            'foundation_date' => '1952/12/25'

        ]);

        Crew::factory()->create([
            'name' => 'XICS',
            'logo' => null,
            'capacity_people' => 23,
            'slogan' => 'ANEM A GUANYAR',
            'color' => null,
            'foundation_date' => '2013/4/3'

        ]);

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
            'profile_photo_path' => 'profile-photos/IAONMyG27oTtIMy6TTGTbJ7h0MrGB0pTCeSsG40Y.png',
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

        User::factory()->create([
            'name' => 'Isaac_Incineroar',
            'email' => 'n@n.n',
            'profile_photo_path' => 'profile-photos/0YbmyuHlY7Ryq8oiD2u51exZ6hKpPaWyfKHbLnY7.jpg',
            'role_id' => $regular->id,
            'password' => 'n'
            ]);
        

        // Martiluski in Los Babus    
        // UserCrew::factory()->create([
        //     'user_id' => 2,
        //     'crew_id' => 1
        // ]);

        UserCrew::factory()->create([
            'user_id' => 3,
            'crew_id' => 1
        ]);

    // Normal users creation
    // User::factory(20)->create();

    // Create ramdom crews
    // Crew::factory(20)->create();
    }
}

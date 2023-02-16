<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Models\Type;
use App\Models\User;
use App\Models\Owner;
use App\Models\Condition;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Item::factory(20)->create();
        // Owner::factory(20)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234')
        ]);

        $conditions = ['New', 'Used'];
        foreach($conditions as $condition){
            Condition::create([
                'name' => $condition
            ]);
        }

        $types = ['For Sale', 'For Buy', 'For Exchange'];
        foreach($types as $type){
            Type::create([
                'name' => $type
            ]);
        }


        $this->call([
            CategorySeeder::class,
        ]);
    }
}

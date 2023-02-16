<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Computer', 'Phone', 'Property', 'Music', 'Fashion', 'Service'];
        foreach($categories as $category){
            Category::create([
                'name' => $category,
                'status' => 'publish'
            ]);
        }
    }
}

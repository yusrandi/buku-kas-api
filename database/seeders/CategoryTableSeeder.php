<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = collect([
            ['name' => 'Lain-Lain', 'role'=>'1'],
            ['name' => 'Pemasukan', 'role'=>'1'],
            ['name' => 'Pencairan', 'role'=>'1'],
            ['name' => 'Lain-Lain', 'role'=>'2'],
            ['name' => 'Hiburan', 'role'=>'2'],
            ['name' => 'Jasa', 'role'=>'2'],
            ['name' => 'Otomotif', 'role'=>'2'],
            ['name' => 'Pendidikan', 'role'=>'2'],
            ['name' => 'Pokok', 'role'=>'2'],
            ['name' => 'Tagihan', 'role'=>'2'],
        ]);

        $data->each(function($data){
            Category::create([
                'name' => $data['name'],
                'role' => $data['role'],
            ]);
        });
    }
}

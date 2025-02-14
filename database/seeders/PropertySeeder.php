<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PropertySeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (($handle = fopen(Storage::path('') . 'property-data.csv', 'r')) !== false) {
            $row = 1;
            while (($data = fgetcsv($handle, 0, ',')) !== false) {
                if ($row === 1) {
                    $row++;
                    continue;
                }

                DB::table('properties')->insert([
                    'name' => $data[0],
                    'price' => $data[1],
                    'bedrooms' => $data[2],
                    'bathrooms' => $data[3],
                    'storeys' => $data[4],
                    'garages' => $data[5],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);

                $row++;
            }

            fclose($handle);
        }
    }
}

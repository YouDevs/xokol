<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Branding', 'icon' => 'fingerprint', 'sort_order' => 1],
            ['name' => 'UI/UX Design', 'icon' => 'dashboard_customize', 'sort_order' => 2],
            ['name' => 'Content Strategy', 'icon' => 'auto_awesome',  'sort_order' => 3],
            ['name' => 'Desarrollo Web', 'icon' => 'code', 'sort_order' => 4],
        ];

        foreach($services as $service) {
            DB::table('services')->updateOrInsert(
                ['name' => $service['name']],

                [
                    'description' => 'Servicio administrable desde CMS.',
                    'icon' => $service['icon'],
                    'is_active' => 1,
                    'sort_order' => $service['sort_order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

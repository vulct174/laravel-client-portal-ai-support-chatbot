<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packs = [
            [
                'name' => 'Free',
                'description' => 'Basic access to the portal.',
                'price' => 0.00,
                'features' => ['Basic Support', 'Community Access'],
            ],
            [
                'name' => 'Essential',
                'description' => 'For small businesses.',
                'price' => 29.00,
                'features' => ['Priority Support', 'Email Support'],
            ],
            [
                'name' => 'Standard',
                'description' => 'For growing teams.',
                'price' => 99.00,
                'features' => ['24/7 Support', 'Phone Support'],
            ],
            [
                'name' => 'Managed',
                'description' => 'We handle everything.',
                'price' => 299.00,
                'features' => ['Dedicated Agent', 'Proactive Monitoring'],
            ],
            [
                'name' => 'Enterprise',
                'description' => 'Custom solutions for large orgs.',
                'price' => 999.00,
                'features' => ['Full Suite', 'SLA'],
            ],
        ];

        foreach ($packs as $pack) {
            \App\Models\Pack::create($pack);
        }
    }
}

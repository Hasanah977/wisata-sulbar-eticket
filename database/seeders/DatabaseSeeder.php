<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Petugas Wisata Default
        User::create([
            'name' => 'Petugas Wisata Sulbar',
            'email' => 'petugas@wisatasulbar.id',
            'password' => Hash::make('password123'),
        ]);

        // 2. Data Contoh Destinasi Sulawesi Barat
        $destinations = [
            [
                'name' => 'Pantai Dato Majene',
                'regency' => 'Majene',
                'description' => 'Pantai berpasir putih dengan tebing karang eksotis dan pemandangan laut lepas khas pesisir Mandar.',
                'price' => 10000,
                'daily_quota' => 200,
                'open_hours' => '07:00 - 18:00 WITA',
                'image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800',
            ],
            [
                'name' => 'Pulau Gusung Toraja',
                'regency' => 'Polewali Mandar',
                'description' => 'Pulau pasir putih di tengah laut dengan air jernih kehijauan yang cocok untuk snorkeling dan bersantai.',
                'price' => 15000,
                'daily_quota' => 150,
                'open_hours' => '08:00 - 17:00 WITA',
                'image' => 'https://images.unsplash.com/photo-1519046904884-53103b34b206?w=800',
            ],
            [
                'name' => 'Anjungan Pantai Manakarra',
                'regency' => 'Mamuju',
                'description' => 'Ikon wisata tepi pantai Kota Mamuju dengan panorama Pulau Karampuang dan kuliner khas.',
                'price' => 5000,
                'daily_quota' => 300,
                'open_hours' => '06:00 - 22:00 WITA',
                'image' => 'https://images.unsplash.com/photo-1473116763249-2faaef81ccda?w=800',
            ],
            [
                'name' => 'Wisata Alam Rantepongko',
                'regency' => 'Mamasa',
                'description' => 'Kawasan pegunungan sejuk dengan hutan pinus, spot foto kabut pagi, dan nuansa budaya Mamasa.',
                'price' => 15000,
                'daily_quota' => 120,
                'open_hours' => '07:30 - 17:30 WITA',
                'image' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800',
            ],
        ];

        foreach ($destinations as $item) {
            Destination::create([
                ...$item,
                'slug' => Str::slug($item['name']),
                'is_active' => true,
            ]);
        }
    }
}

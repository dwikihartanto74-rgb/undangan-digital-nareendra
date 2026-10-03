<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        User::updateOrCreate(['email' => 'admin@admin.com'], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);

        // Create default invitation settings if empty
        if (\App\Models\InvitationSetting::count() == 0) {
            \App\Models\InvitationSetting::create([
                'baby_name' => 'Ahmad Nareendra',
                'baby_nickname' => 'Azka',
                'birth_place' => 'Jambi',
                'birth_date' => '2026-08-04',
                'birth_order' => 1,
                'weight' => 3.5,
                'height' => 50,
                'father_name' => 'Bapak Budi',
                'mother_name' => 'Ibu Siti',
                'event_date' => '2026-09-10',
                'event_time' => '09:00:00',
                'venue' => 'Langgar Jamiatus Sholihin',
                'address' => 'Jl. Merpati, Lrg. Kasuari Kel. Pakuan Baru, Kec. Jambi Selatan, Kota Jambi.',
                'maps_url' => 'https://share.google/VVteEtfLH5F0F8bc9',
                'countdown_datetime' => '2026-09-10 09:00:00',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    public function run()
    {
        Announcement::create([
            'title' => 'COVID-19 Safety Measures',
            'content' => "We're here to help. Learn more about our safety measures.",
            'start_date' => Carbon::now()->subDays(5),
            'end_date' => Carbon::now()->addDays(10),
            'is_active' => true
        ]);

        Announcement::create([
            'title' => 'New Feature: Video Consultation',
            'content' => "Now you can book video consultations with our specialists!",
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(15),
            'is_active' => true
        ]);
    }
}

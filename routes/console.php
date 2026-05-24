<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Jadwal harian untuk mengirim email pengingat H-1 deadline peminjaman pada pukul 08:00 pagi
Schedule::command('peminjaman:remind-deadline')->dailyAt('08:00');

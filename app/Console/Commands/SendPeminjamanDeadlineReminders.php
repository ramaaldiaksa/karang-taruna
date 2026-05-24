<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

use App\Models\Peminjaman;
use App\Mail\PeminjamanDeadlineReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

#[Signature('peminjaman:remind-deadline')]
#[Description('Kirim email pengingat otomatis ke masyarakat 1 hari sebelum rencana pengembalian habis (H-1)')]
class SendPeminjamanDeadlineReminders extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();
        
        // Cari peminjaman disetujui yang batas kembalinya besok
        $peminjamans = Peminjaman::where('status', 'disetujui')
            ->whereDate('rencana_kembali', $tomorrow)
            ->with(['masyarakat', 'detail.inventaris'])
            ->get();

        $this->info("Menemukan " . $peminjamans->count() . " peminjaman dengan deadline esok hari ({$tomorrow}).");

        if ($peminjamans->isEmpty()) {
            $this->info("Tidak ada email pengingat yang perlu dikirim hari ini.");
            return Command::SUCCESS;
        }

        $successCount = 0;
        $failCount = 0;

        foreach ($peminjamans as $peminjaman) {
            if ($peminjaman->masyarakat && $peminjaman->masyarakat->email) {
                try {
                    Mail::to($peminjaman->masyarakat->email)
                        ->send(new PeminjamanDeadlineReminderMail($peminjaman));
                    
                    $successCount++;
                    $this->line("-> Berhasil mengirim pengingat ke: {$peminjaman->masyarakat->email}");
                } catch (\Exception $e) {
                    $failCount++;
                    $this->error("-> Gagal mengirim ke: {$peminjaman->masyarakat->email}. Error: " . $e->getMessage());
                    Log::error("Gagal mengirim email pengingat deadline H-1 peminjaman #{$peminjaman->id_peminjaman}: " . $e->getMessage());
                }
            } else {
                $this->warn("-> Peminjaman #{$peminjaman->id_peminjaman} tidak memiliki email masyarakat valid.");
            }
        }

        $this->info("Selesai memproses. Sukses: {$successCount}, Gagal: {$failCount}.");
        return Command::SUCCESS;
    }
}

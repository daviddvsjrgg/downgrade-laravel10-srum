<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;
use App\Models\Collection;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array fakultas dan program studi
        $fakultasProdi = [
            'Fakultas Teknik' => ['Teknik Informatika', 'Teknik Elektro', 'Teknik Sipil'],
            'Fakultas Ekonomi' => ['Manajemen', 'Akuntansi', 'Ekonomi Pembangunan'],
            'Fakultas Ilmu Sosial' => ['Sosiologi', 'Ilmu Komunikasi', 'Hubungan Internasional'],
            'Fakultas Hukum' => ['Ilmu Hukum'],
            'Fakultas Kedokteran' => ['Pendidikan Dokter', 'Kedokteran Gigi'],
        ];

        for ($i = 1; $i <= 500; $i++) {
            // Pilih fakultas secara acak
            $fakultas = Arr::random(array_keys($fakultasProdi));

            // Pilih program studi berdasarkan fakultas yang dipilih
            $programStudi = Arr::random($fakultasProdi[$fakultas]);

            Collection::create([
                'judul_tugas_akhir' => "Sistem Informasi Perpustakaan Vol. $i",
                'nama_penulis' => "Ahmad Fauzi $i",
                'nama_pembimbing' => "Dr. Budi Santoso",
                'program_studi' => $programStudi,
                'fakultas' => $fakultas,
                'tahun_terbit' => 2023,
                'abstrak_indo' => "Penelitian ini membahas tentang topik ke-$i ...",
                'abstrak_eng' => "This research discusses topic number $i ...",
                'nomer_reg' => "TI-2023-" . str_pad($i, 3, '0', STR_PAD_LEFT),
                'kata_kunci' => 'perpustakaan, sistem informasi, database',
                'tanggal_unggah' => Carbon::createFromTimestamp(
                    rand(
                        Carbon::now()->subYears(2)->timestamp,
                        Carbon::now()->timestamp
                    )
                )->toDateString(),
                'status' => 'Belum Tersedia',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Soal;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'soal' => 'Kerjasama - Karyawan senior mampu menjalin kerjasama yang baik untuk berkomitmen menyelesaikan proses job shadowing',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Etika Kerja - Karyawan senior menunjukkan sikap bersahabat dalam berprilaku dan selalu membangun iklim kerja yang positif',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Inisiatif - Karyawan senior secara proaktif memberikan pengetahuan yang dibutuhkan dalam menyelesaikan pekerjaan tanpa ketergantungan pada perintah atasan',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Penyampaian Materi - Cara penyampaian materi yang diberikan karyawan senior mudah dipahami',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Penggunaan Alat Bantu - Karyawan senior menggunakan alat bantu (model, software, rumus yang mudah dipahami) dalam menjelaskan materi ajar',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Komunikasi - Karyawan senior mampu berkomunikasi dengan baik sehingga target job shadowing terselesaikan dengan baik',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Aplikasi Ilmu - pengetahuan yang diberikan oleh karyawan senior bermanfaat untuk saya (karyawan junior) dan dapat digunakan untuk target pekerjaan',
                'to'   => 'Junior'
            ],
            [
                'soal' => 'Continuous Learning - Karyawan senior menunjukkan antusiasme dalam proses pembelajaran',
                'to'   => 'Junior'
            ],

            [
                'soal' => 'Kerjasama - Karyawan junior mampu menjalin kerjasama yang baik untuk berkomitmen menyelesaikan proses job shadowing',
                'to'   => 'Senior'
            ],

            [
                'soal' => 'Etika Kerja - Karyawan junior menunjukkan sikap bersahabat dalam berprilaku dan selalu membangun iklim kerja yang positif',
                'to'   => 'Senior'
            ],
            [
                'soal' => 'Inisiatif - Karyawan junior secara proaktif memberikan pengetahuan yang dibutuhkan dalam menyelesaikan pekerjaan tanpa ketergantungan pada perintah atasan',
                'to'   => 'Senior'
            ],
            [
                'soal' => 'Penyampaian Materi - Materi yang telah disampaikan dapat dengan mudah diterima dan dipahami oleh karyawan junior',
                'to'   => 'Senior'
            ],
            [
                'soal' => 'Penggunaan Alat Bantu - Karyawan junior dapat dengan mudah memahami alat bantu yang digunakan (model, software, rumus) dalam menjelaskan materi ajar',
                'to'   => 'Senior'
            ],
            [
                'soal' => 'Komunikasi - Karyawan junior mampu berkomunikasi dengan baik sehingga target job shadowing terselesaikan dengan baik',
                'to'   => 'Senior'
            ],
            [
                'soal' => 'Continuous Learning - Karyawan junior menunjukkan antusiasme dalam proses pembelajaran',
                'to'   => 'Senior'
            ], 
        ];
    
        foreach ($roles as $soal) {
            Soal::Create(
                ['soal' => $soal['soal'], 'to' => $soal['to']],
                $soal
            );
        }
    }
}

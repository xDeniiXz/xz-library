<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'judul' => 'Atomic Habits',
                'penulis' => 'James Clear',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2019,
                'isbn' => '9786020633176',
                'stok' => 15,
                'sinopsis' => 'Buku ini menawarkan kerangka kerja yang terbukti untuk meningkatkan diri setiap hari. James Clear mengungkapkan strategi praktis yang akan mengajarkan Anda cara membangun kebiasaan baik, menghentikan kebiasaan buruk, dan menguasai perubahan perilaku kecil yang mengarah pada hasil yang luar biasa.',
                'kategori' => 'Pengembangan Diri',
            ],
            [
                'judul' => 'The Psychology of Money',
                'penulis' => 'Morgan Housel',
                'penerbit' => 'Harriman House',
                'tahun_terbit' => 2020,
                'isbn' => '9781804090039',
                'stok' => 10,
                'sinopsis' => 'Berurusan dengan uang tidak selalu tentang apa yang Anda ketahui. Ini tentang bagaimana Anda berperilaku. Dan perilaku sulit untuk diajarkan, bahkan kepada orang yang sangat cerdas sekalipun. Housel berbagi 19 cerita pendek yang mengeksplorasi cara aneh orang berpikir tentang uang.',
                'kategori' => 'Ekonomi',
            ],
            [
                'judul' => 'It Ends with Us',
                'penulis' => 'Colleen Hoover',
                'penerbit' => 'Atria Books',
                'tahun_terbit' => 2016,
                'isbn' => '9781501110368',
                'stok' => 20,
                'sinopsis' => 'Lily belum selalu merasa mudah, tetapi itu tidak pernah menghentikannya untuk bekerja keras demi kehidupan yang dia inginkan. Dia telah menempuh perjalanan jauh dari kota kecil di Maine tempat dia tumbuh besar. Sebuah kisah emosional tentang cinta, pengkhianatan, dan keberanian untuk membuat pilihan sulit.',
                'kategori' => 'Novel',
            ],
            [
                'judul' => 'The Midnight Library',
                'penulis' => 'Matt Haig',
                'penerbit' => 'Canongate Books',
                'tahun_terbit' => 2020,
                'isbn' => '9781786892706',
                'stok' => 12,
                'sinopsis' => 'Di antara hidup dan mati ada sebuah perpustakaan, dan di dalam perpustakaan itu, rak-raknya terus berlanjut selamanya. Setiap buku memberikan kesempatan untuk mencoba kehidupan lain yang bisa Anda jalani. Nora Seed harus memutuskan kehidupan mana yang benar-benar layak dijalani.',
                'kategori' => 'Fiksi',
            ],
            [
                'judul' => 'Almond',
                'penulis' => 'Won-pyung Sohn',
                'penerbit' => 'Gramedia Pustaka Utama',
                'tahun_terbit' => 2017,
                'isbn' => '9786020633510',
                'stok' => 8,
                'sinopsis' => 'Yunjae lahir dengan kondisi neurologis yang disebut Alexithymia yang membuatnya sulit merasakan emosi seperti rasa takut atau marah. Dia tidak memiliki teman sampai suatu hari seorang anak laki-laki bernama Gon masuk ke hidupnya, memulai persahabatan yang tidak terduga.',
                'kategori' => 'Sastra',
            ],
            [
                'judul' => 'Laut Bercerita',
                'penulis' => 'Leila S. Chudori',
                'penerbit' => 'Kepustakaan Populer Gramedia',
                'tahun_terbit' => 2017,
                'isbn' => '9786024246938',
                'stok' => 25,
                'sinopsis' => 'Sebuah novel yang menceritakan tentang kekejaman era Orde Baru terhadap para aktivis mahasiswa. Melalui tokoh Biru Laut, kita diajak menyelami perjuangan, rasa sakit, dan kerinduan keluarga yang kehilangan anggota mereka tanpa kejelasan.',
                'kategori' => 'Novel',
            ],
            [
                'judul' => 'Filosofi Teras',
                'penulis' => 'Henry Manampiring',
                'penerbit' => 'Buku Kompas',
                'tahun_terbit' => 2018,
                'isbn' => '9786024125189',
                'stok' => 30,
                'sinopsis' => 'Buku ini memperkenalkan Stoisisme, filsafat Yunani-Romawi kuno, dengan cara yang relevan bagi kehidupan modern di Indonesia. Membantu pembaca menemukan kedamaian batin dan ketangguhan mental dalam menghadapi masalah hidup sehari-hari.',
                'kategori' => 'Filsafat',
            ],
            [
                'judul' => 'The Seven Husbands of Evelyn Hugo',
                'penulis' => 'Taylor Jenkins Reid',
                'penerbit' => 'Atria Books',
                'tahun_terbit' => 2017,
                'isbn' => '9781501139239',
                'stok' => 14,
                'sinopsis' => 'Ikon film Hollywood yang menua, Evelyn Hugo, siap menceritakan kisah hidupnya yang penuh glamor dan skandal. Dia memilih reporter majalah yang tidak dikenal, Monique Grant, untuk menulis biografinya dan menceritakan tentang tujuh suaminya—dan satu cinta sejatinya.',
                'kategori' => 'Fiksi',
            ],
            [
                'judul' => 'Rich Dad Poor Dad',
                'penulis' => 'Robert T. Kiyosaki',
                'penerbit' => 'Plata Publishing',
                'tahun_terbit' => 2017,
                'isbn' => '9781612680194',
                'stok' => 18,
                'sinopsis' => 'Buku keuangan pribadi nomor satu sepanjang masa. Robert Kiyosaki menceritakan kisah dua ayahnya—ayah kandungnya dan ayah dari sahabatnya—dan cara kedua pria tersebut membentuk pandangannya tentang uang dan investasi.',
                'kategori' => 'Ekonomi',
            ],
            [
                'judul' => 'Sapiens: A Brief History of Humankind',
                'penulis' => 'Yuval Noah Harari',
                'penerbit' => 'Harper',
                'tahun_terbit' => 2014,
                'isbn' => '9780062316097',
                'stok' => 9,
                'sinopsis' => 'Yuval Noah Harari menyapu sejarah seluruh umat manusia, dari manusia pertama yang berjalan di bumi hingga terobosan radikal—dan terkadang menghancurkan—dari Revolusi Kognitif, Pertanian, dan Ilmiah.',
                'kategori' => 'Sejarah',
            ],
            [
                'judul' => 'Bicara Itu Ada Seninya',
                'penulis' => 'Oh Su Hyang',
                'penerbit' => 'Bhuana Ilmu Populer',
                'tahun_terbit' => 2018,
                'isbn' => '9786024553920',
                'stok' => 22,
                'sinopsis' => 'Komunikasi bukan hanya tentang berbicara, tetapi tentang bagaimana menyampaikan pesan dengan efektif. Pakar komunikasi Oh Su Hyang membagikan rahasia dan teknik untuk meningkatkan kemampuan berbicara dan memenangkan hati orang lain.',
                'kategori' => 'Pengembangan Diri',
            ],
            [
                'judul' => 'Ikigai: The Japanese Secret to a Long and Happy Life',
                'penulis' => 'Héctor García',
                'penerbit' => 'Penguin Life',
                'tahun_terbit' => 2016,
                'isbn' => '9780143130727',
                'stok' => 16,
                'sinopsis' => 'Temukan ikigai Anda (alasan untuk bangun di pagi hari) dan temukan kunci untuk hidup yang lebih lama dan lebih bahagia. Buku ini mengeksplorasi gaya hidup masyarakat Okinawa yang memiliki jumlah centenarian tertinggi di dunia.',
                'kategori' => 'Psikologi',
            ],
        ];

        foreach ($books as $bookData) {
            $kategoriNama = $bookData['kategori'];
            unset($bookData['kategori']);

            $kategori = Kategori::where('nama_kategori', $kategoriNama)->first();

            if ($kategori) {
                $bookData['kategori_id'] = $kategori->id;
                Buku::firstOrCreate(
                    ['isbn' => $bookData['isbn']],
                    $bookData
                );
            }
        }
    }
}

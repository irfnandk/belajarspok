<?php
class SentenceParser {
    // DAFTAR KATA KERJA LENGKAP (termasuk bentuk berimbuhan)
    private $kataKerja = [
        // Bentuk dasar
        'makan','minum','pergi','datang','belajar','baca','tulis','lihat','dengar',
        'jalan','lari','tidur','bangun','mandi','pakai','buat','ambil','beri',
        'terima','kirim','bawa','antar','jemput','tunggu','duduk','berdiri',
        'bicara','cerita','tanya','jawab','panggil','kenal','sayang','cinta',
        'suka','benci','marah','sedih','senang','masak','cuci','setrika','sapu',
        'pel','kunci','buka','tutup','nyalakan','matikan','naik','turun','kerja',
        'tulis','gambar','nyanyi','menari','berlari','berjalan','bermain',
        'membaca','menulis','menggambar','menyanyi','berenang','terbang',
        'berkata','bercerita','bertanya','menjawab','menjadi','merupakan',
        'adalah','ialah','termasuk','terdiri','berisi','memiliki','mempunyai',
        'mengandung','mengerjakan','menuliskan','menggambarkan','menyanyikan',
        'menari','berlari','berjalan','bermain','membaca','menulis','menggambar',
        'menyanyi','berenang','terbang','berkata','bercerita','bertanya','menjawab',
        
        // Bentuk berimbuhan meN-
        'memakan','meminum','mempergi','mendatangi','mempelajari','membaca','menulis','melihat','mendengar',
        'menjalan','melari','menidur','membangun','memandikan','memakai','membuat','mengambil','memberi',
        'menerima','mengirim','membawa','mengantar','menjemput','menunggu','menduduki','berdiri',
        'berbicara','bercerita','bertanya','menjawab','memanggil','mengenal','menyayangi','mencintai',
        'menyukai','membenci','memarahi','bersedih','bersenang','memasak','mencuci','menyetrika','menyapu',
        'mengepel','mengunci','membuka','menutup','menyalakan','mematikan','menaiki','menuruni','bekerja',
        'menulis','menggambar','menyanyi','menari','berlari','berjalan','bermain','membaca','menulis',
        'menggambar','menyanyi','berenang','terbang','berkata','bercerita','bertanya','menjawab',
        'menjadi','merupakan','termasuk','terdiri','berisi','memiliki','mempunyai','mengandung',
        'mengerjakan','menuliskan','menggambarkan','menyanyikan','menari','berlari','berjalan','bermain',
        'membaca','menulis','menggambar','menyanyi','berenang','terbang','berkata','bercerita','bertanya',
        'menjawab','mengajar','belajar','mengerti','paham','memahami','menguasai',
        
        // Bentuk di-
        'dimakan','diminum','dipergi','didatangi','dipelajari','dibaca','ditulis','dilihat','didengar',
        'dijalani','dilarikan','ditiduri','dibangun','dimandikan','dipakai','dibuat','diambil','diberi',
        'diterima','dikirim','dibawa','diantar','dijemput','ditunggu','diduduki','diberdirikan',
        'dibicarakan','dicaritakan','ditanyai','dijawab','dipanggil','dikenal','disayangi','dicintai',
        'disukai','dibenarkan','dimarahi','disedihkan','disenangkan','dimasak','dicuci','disetrika',
        'disapu','dipel','dikunci','dibuka','ditutup','dinyalakan','dimatikan','dinaiki','diturunkan',
        'dikerjakan','dituliskan','digambarkan','dinyanyikan','ditari','dilarikan','dijalani','dimainkan',
        'dibaca','ditulis','digambar','dinyanyi','direnang','diterbangkan','dikatakan','diceritakan',
        
        // Bentuk ter-
        'termakan','terminum','terpergi','terdatang','terpelajar','terbaca','tertulis','terlihat','terdengar',
        'terjalan','terlari','tertidur','terbangun','termandi','terpakai','terbuat','terambil','terberi',
        'terima','terkirim','terbawa','terantar','terjemput','tertunggu','terduduk','terberdiri',
        'terbicara','tercerita','tertanya','terjawab','terpanggil','terkenal','tersayang','tercinta',
        'tersuka','terbenci','termarah','tersedih','tersenang','termasak','tercuci','tersetrika',
        'tersapu','terpel','terkunci','terbuka','tertutup','ternyalakan','termatikan','ternaiki',
        
        // Bentuk ber-
        'bermakan','berminum','berpergi','berdatangan','berpelajaran','berbaca','bertulis','berlihat','berdengar',
        'berjalan','berlari','bertidur','berbangun','bermandi','berpakai','berbuat','berambil','berberi',
        'berterima','berkirim','berbawa','berantar','berjemput','bertunggu','berduduk','berdiri',
        'berbicara','bercerita','bertanya','berjawab','berpanggil','berkenal','bersayang','bercinta',
        'bersuka','berbenci','bermarah','bersedih','bersenang','bermasak','bercuci','bersetrika',
        'bersapu','berpel','berkunci','berbuka','bertutup','bernyalakan','bermatikan','bernaiki',
        
        // Kata kerja bantu dan kopula
        'adalah','ialah','merupakan','menjadi','termasuk','terdiri','berisi'
    ];

    // DAFTAR KATA BENDA (diperluas)
    private $kataBenda = [
        'saya','aku','kamu','dia','mereka','kami','kita','anda','ibu','bapak','ayah',
        'anak','adik','kakak','nenek','kakek','paman','bibi','teman','guru',
        'dokter','perawat','polisi','tentara','presiden','menteri','rumah',
        'sekolah','kantor','pasar','toko','buku','pensil','penghapus','meja',
        'kursi','papan','mobil','motor','bus','kereta','kapal','pesawat',
        'jalan','kota','desa','negara','air','api','tanah','udara','matahari',
        'bulan','bintang','orang','hewan','tumbuhan','buah','sayur','ikan',
        'ayam','kambing','sapi','kerbau','kuda','gajah','harimau','singa',
        'ular','burung','kupu','lebah','semut','laba','nyamuk','kecoa',
        'belalang','capung','nasi','lauk','sayuran','daging','telur','tahu',
        'tempe','garam','gula','minyak','roti','kue','pisang','mangga','jeruk',
        'apel','anggur','semangka','melon','pepaya','nanas','rambutan','durian',
        'coklat','keju','susu','teh','kopi','jus','kucing','anjing','kelinci',
        'kambing','domba','kerbau','kuda','bebek','angsa','merpati','elang',
        'tokoh','rakyat','pemimpin','pahlawan','ilmuwan','seniman','petani',
        'nelayan','pedagang','karyawan','pegawai','siswa','mahasiswa','pelajar'
    ];

    private $preposisi = [
        'di','ke','dari','pada','untuk','dengan','tanpa','oleh','karena',
        'sejak','sampai','tentang','antara','bagi','akan','kepada','demi',
        'kecuali','selain','seperti','bagai','sampai','sepanjang','sejauh'
    ];

    public function parse($sentence) {
        $words = $this->tokenize($sentence);
        $result = ['subject' => null, 'predicate' => null, 'object' => null, 'adverb' => null, 'error' => null];

        // 1. Cari predikat (kata kerja)
        $predicateIndex = -1;
        foreach ($words as $index => $word) {
            $lower = strtolower($word);
            if (in_array($lower, $this->kataKerja)) {
                $predicateIndex = $index;
                $result['predicate'] = $word;
                break;
            }
        }

        if ($predicateIndex === -1) {
            $result['error'] = 'Tidak ditemukan kata kerja (predikat).';
            return $result;
        }

        // 2. Cari subjek (kata benda sebelum predikat)
        if ($predicateIndex > 0) {
            for ($i = $predicateIndex - 1; $i >= 0; $i--) {
                $lower = strtolower($words[$i]);
                if (in_array($lower, $this->kataBenda)) {
                    $result['subject'] = $words[$i];
                    break;
                }
            }
            if ($result['subject'] === null) {
                $result['subject'] = $words[0];
            }
        }

        // 3. Cari objek
        if ($predicateIndex < count($words) - 1) {
            $nextWord = $words[$predicateIndex + 1];
            $lower = strtolower($nextWord);
            if (!in_array($lower, $this->preposisi) && !in_array($lower, $this->kataKerja)) {
                $result['object'] = $nextWord;
            }
        }

        // 4. Cari keterangan
        if ($predicateIndex < count($words) - 1) {
            $adverbParts = [];
            for ($i = $predicateIndex + 1; $i < count($words); $i++) {
                $word = $words[$i];
                $lower = strtolower($word);
                if (in_array($lower, $this->preposisi) || ($result['object'] !== null && $i > $predicateIndex + 1)) {
                    $adverbParts[] = $word;
                }
            }
            if (!empty($adverbParts)) {
                $result['adverb'] = implode(' ', $adverbParts);
            }
        }

        return $result;
    }

    private function tokenize($sentence) {
        $sentence = preg_replace('/[.,!?;:"]/', '', $sentence);
        return explode(' ', trim($sentence));
    }

    public function correctOrder($sentence) {
        $parsed = $this->parse($sentence);
        if ($parsed['error']) {
            return ['original' => $sentence, 'corrected' => null, 'is_correct' => false, 'parsed' => $parsed];
        }

        $corrected = [];
        if ($parsed['subject']) $corrected[] = $parsed['subject'];
        if ($parsed['predicate']) $corrected[] = $parsed['predicate'];
        if ($parsed['object']) $corrected[] = $parsed['object'];
        if ($parsed['adverb']) $corrected[] = $parsed['adverb'];

        $correctedSentence = implode(' ', $corrected);

        // PERBAIKAN: Hapus tanda baca dari kedua string sebelum dibandingkan
        $originalClean = preg_replace('/[.,!?;:"]/', '', trim($sentence));
        $correctedClean = preg_replace('/[.,!?;:"]/', '', trim($correctedSentence));

        return [
            'original' => $sentence,
            'corrected' => $correctedSentence,
            'is_correct' => ($originalClean === $correctedClean),
            'parsed' => $parsed
        ];
    }
}
?>
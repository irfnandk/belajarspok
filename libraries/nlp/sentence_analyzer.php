<?php
class SentenceAnalyzer {
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

    private $kataKerja = [
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
        'dimakan','diminum','dipergi','didatangi','dipelajari','dibaca','ditulis','dilihat','didengar',
        'dijalani','dilarikan','ditiduri','dibangun','dimandikan','dipakai','dibuat','diambil','diberi',
        'diterima','dikirim','dibawa','diantar','dijemput','ditunggu','diduduki','diberdirikan',
        'dibicarakan','dicaritakan','ditanyai','dijawab','dipanggil','dikenal','disayangi','dicintai',
        'disukai','dibenarkan','dimarahi','disedihkan','disenangkan','dimasak','dicuci','disetrika',
        'disapu','dipel','dikunci','dibuka','ditutup','dinyalakan','dimatikan','dinaiki','diturunkan',
        'dikerjakan','dituliskan','digambarkan','dinyanyikan','ditari','dilarikan','dijalani','dimainkan',
        'dibaca','ditulis','digambar','dinyanyi','direnang','diterbangkan','dikatakan','diceritakan',
        'termakan','terminum','terpergi','terdatang','terpelajar','terbaca','tertulis','terlihat','terdengar',
        'terjalan','terlari','tertidur','terbangun','termandi','terpakai','terbuat','terambil','terberi',
        'terima','terkirim','terbawa','terantar','terjemput','tertunggu','terduduk','terberdiri',
        'terbicara','tercerita','tertanya','terjawab','terpanggil','terkenal','tersayang','tercinta',
        'tersuka','terbenci','termarah','tersedih','tersenang','termasak','tercuci','tersetrika',
        'tersapu','terpel','terkunci','terbuka','tertutup','ternyalakan','termatikan','ternaiki',
        'bermakan','berminum','berpergi','berdatangan','berpelajaran','berbaca','bertulis','berlihat','berdengar',
        'berjalan','berlari','bertidur','berbangun','bermandi','berpakai','berbuat','berambil','berberi',
        'berterima','berkirim','berbawa','berantar','berjemput','bertunggu','berduduk','berdiri',
        'berbicara','bercerita','bertanya','berjawab','berpanggil','berkenal','bersayang','bercinta',
        'bersuka','berbenci','bermarah','bersedih','bersenang','bermasak','bercuci','bersetrika',
        'bersapu','berpel','berkunci','berbuka','bertutup','bernyalakan','bermatikan','bernaiki',
        'adalah','ialah','merupakan','menjadi','termasuk','terdiri','berisi'
    ];

    private $kataSifat = [
        'besar','kecil','tinggi','rendah','panjang','pendek','baik','buruk',
        'indah','jelek','cantik','ganteng','manis','asin','pedas','manis',
        'pahit','asam','segar','busuk','harum','wangi','berat','ringan',
        'keras','lunak','halus','kasar','bersih','kotor','terang','gelap',
        'hangat','dingin','panas','sejuk','ramai','sepi','sibuk','malas',
        'rajin','pintar','bodoh','cerdas','ungu','merah','kuning','hijau',
        'biru','hitam','putih','abu','coklat','oranye'
    ];

    private $preposisi = [
        'di','ke','dari','pada','untuk','dengan','tanpa','oleh','karena',
        'sejak','sampai','tentang','antara','bagi','akan','kepada','demi',
        'kecuali','selain','seperti','bagai','sampai','sepanjang','sejauh'
    ];

    private $konjungsi = [
        'dan','atau','tetapi','namun','sedangkan','karena','sehingga','maka',
        'jika','kalau','meskipun','walaupun','seperti','bagaikan','agar','supaya',
        'bahwa','untuk','sambil','seraya','sebab','kecuali','selain','setelah',
        'sebelum','ketika','saat','sewaktu','sementara'
    ];

    private $pronomina = [
        'saya','aku','kamu','engkau','dia','beliau','mereka','kami','kita',
        'anda','-ku','-mu','-nya','kalian','kita','kami','mereka','ia','beliau'
    ];

    private $awalan = [
        'me','di','ter','ber','ke','pe','se','mem','men','meng','meny','pen','per','pel','pem'
    ];

    private $akhiran = [
        'kan','i','lah','kah','pun','nya','an','wan','wati','man','an','i'
    ];

    public function analyze($sentence) {
        $words = $this->tokenize($sentence);
        $result = [
            'jenis_kalimat' => $this->detectSentenceType($sentence),
            'aktif_pasif' => $this->detectVoice($words),
            'kalimat_majemuk' => $this->detectCompound($sentence),
            'klausa' => $this->detectClauses($sentence),
            'pos_tags' => $this->tagPOS($words),
            'frasa' => $this->detectPhrases($words),
            'imbuhan' => $this->detectAffixes($words),
            'efektifitas' => $this->checkEffectiveness($sentence, $words),
            'keterbacaan' => $this->readability($sentence),
            'semantik' => $this->semanticAnalysis($words),
            'saran_gaya' => $this->styleSuggestions($sentence, $words)
        ];
        return $result;
    }

    private function tokenize($sentence) {
        $sentence = preg_replace('/[.,!?;:"]/', '', $sentence);
        return explode(' ', trim($sentence));
    }

    private function detectSentenceType($sentence) {
        if (preg_match('/\?$/', $sentence)) return 'Interogatif (tanya)';
        if (preg_match('/\!$/', $sentence)) return 'Eksklamatif (seru)';
        $firstWord = strtok($sentence, ' ');
        $verbs = ['tolong','mohon','coba','silakan','jangan','marilah','ayolah','biarlah','hendaklah','sebaiknya'];
        if (in_array(strtolower($firstWord), $verbs) || strpos($sentence, 'lah') !== false) {
            return 'Imperatif (perintah)';
        }
        return 'Deklaratif (pernyataan)';
    }

    private function detectVoice($words) {
        $hasDi = false; $hasMe = false; $hasTer = false; $hasBer = false;
        foreach ($words as $w) {
            $w = strtolower($w);
            if (strpos($w, 'di') === 0 && strlen($w)>2) $hasDi = true;
            if (strpos($w, 'me') === 0 || strpos($w, 'mem') === 0 || strpos($w, 'men') === 0 || strpos($w, 'meng') === 0 || strpos($w, 'meny') === 0) $hasMe = true;
            if (strpos($w, 'ter') === 0) $hasTer = true;
            if (strpos($w, 'ber') === 0) $hasBer = true;
        }
        if ($hasDi) return 'Pasif (di-)';
        if ($hasTer && !$hasMe) return 'Pasif (ter-)';
        if ($hasMe || $hasBer) return 'Aktif';
        return 'Netral / Tidak terdeteksi';
    }

    private function detectCompound($sentence) {
        $connectors = ['dan','atau','tetapi','namun','sedangkan','karena','sehingga','maka','jika','kalau','meskipun','walaupun','sambil','seraya','sebab','kecuali','setelah','sebelum','ketika','saat'];
        $count = 0;
        foreach ($connectors as $conj) {
            if (strpos(strtolower($sentence), ' ' . $conj . ' ') !== false) {
                $count++;
            }
        }
        if ($count >= 2) return 'Kalimat majemuk bertingkat (lebih dari 2 klausa)';
        if ($count == 1) return 'Kalimat majemuk setara (2 klausa)';
        return 'Kalimat tunggal';
    }

    private function detectClauses($sentence) {
        $delimiters = [' dan ', ' atau ', ' tetapi ', ' namun ', ' sedangkan ', ' karena ', ' sehingga ', ' maka ', ' jika ', ' kalau ', ' meskipun ', ' walaupun ', ', '];
        $clauses = [$sentence];
        foreach ($delimiters as $del) {
            if (strpos($sentence, $del) !== false) {
                $parts = explode($del, $sentence);
                $clauses = $parts;
                break;
            }
        }
        return $clauses;
    }

    private function tagPOS($words) {
        $tags = [];
        foreach ($words as $w) {
            $clean = strtolower(trim($w));
            $tag = 'Lain-lain';
            if (in_array($clean, $this->kataBenda)) $tag = 'Nomina (kata benda)';
            elseif (in_array($clean, $this->kataKerja)) $tag = 'Verba (kata kerja)';
            elseif (in_array($clean, $this->kataSifat)) $tag = 'Adjektiva (kata sifat)';
            elseif (in_array($clean, $this->preposisi)) $tag = 'Preposisi (kata depan)';
            elseif (in_array($clean, $this->konjungsi)) $tag = 'Konjungsi (kata sambung)';
            elseif (in_array($clean, $this->pronomina)) $tag = 'Pronomina (kata ganti)';
            elseif (preg_match('/^[a-z]+(kan|i|lah|kah|pun)$/', $clean)) $tag = 'Verba berimbuhan';
            $tags[] = ['word' => $w, 'tag' => $tag];
        }
        return $tags;
    }

    private function detectPhrases($words) {
        $phrases = [];
        $temp = [];
        $types = [
            'Nomina' => $this->kataBenda,
            'Verba' => $this->kataKerja,
            'Adjektiva' => $this->kataSifat,
            'Preposisi' => $this->preposisi
        ];
        foreach ($words as $i => $w) {
            $clean = strtolower($w);
            $found = null;
            foreach ($types as $type => $list) {
                if (in_array($clean, $list)) { $found = $type; break; }
            }
            $temp[] = $found;
        }
        $current = null; $phrase = [];
        foreach ($temp as $i => $t) {
            if ($t && $t == $current) {
                $phrase[] = $words[$i];
            } elseif ($t) {
                if (!empty($phrase)) {
                    $phrases[] = ['type' => $current, 'words' => implode(' ', $phrase)];
                }
                $current = $t;
                $phrase = [$words[$i]];
            } else {
                if (!empty($phrase)) {
                    $phrases[] = ['type' => $current, 'words' => implode(' ', $phrase)];
                }
                $current = null;
                $phrase = [];
            }
        }
        if (!empty($phrase)) {
            $phrases[] = ['type' => $current, 'words' => implode(' ', $phrase)];
        }
        return $phrases;
    }

    private function detectAffixes($words) {
        $result = [];
        $awalan = ['me','di','ter','ber','ke','pe','se','mem','men','meng','meny','pen','per','pel','pem'];
        $akhiran = ['kan','i','lah','kah','pun','nya','an','wan','wati','man','an','i'];
        foreach ($words as $w) {
            $clean = strtolower($w);
            $affixes = [];
            foreach ($awalan as $pre) {
                if (strpos($clean, $pre) === 0 && strlen($pre) < strlen($clean)) {
                    $affixes[] = $pre;
                    break;
                }
            }
            foreach ($akhiran as $suf) {
                if (substr($clean, -strlen($suf)) == $suf && strlen($suf) < strlen($clean)) {
                    $affixes[] = $suf;
                    break;
                }
            }
            if (!empty($affixes)) {
                $result[$w] = $affixes;
            }
        }
        return $result;
    }

    private function checkEffectiveness($sentence, $words) {
        $issues = [];
        $wordCounts = array_count_values(array_map('strtolower', $words));
        foreach ($wordCounts as $w => $count) {
            if ($count > 2) $issues[] = "Kata '{$w}' diulang terlalu sering ($count kali).";
        }
        $mubazirPairs = ['agar supaya', 'sebab karena', 'untuk bagi', 'demi untuk', 'karena sebab', 'dan serta', 'baik buruk'];
        $text = strtolower($sentence);
        foreach ($mubazirPairs as $pair) {
            if (strpos($text, $pair) !== false) {
                $issues[] = "Ada pemakaian kata mubazir: '$pair'.";
            }
        }
        if (strlen($sentence) > 100 && strpos($sentence, ',') === false && strpos($sentence, ';') === false) {
            $issues[] = "Kalimat panjang tanpa tanda baca, potensi ambigu.";
        }
        return ['issues' => $issues, 'is_effective' => empty($issues)];
    }

    private function readability($sentence) {
        $words = explode(' ', trim($sentence));
        $numWords = count($words);
        $numChars = strlen(str_replace(' ', '', $sentence));
        $avgWordLen = $numWords > 0 ? $numChars / $numWords : 0;
        $syllables = 0;
        foreach ($words as $w) {
            $syllables += $this->countSyllables($w);
        }
        $score = 206.835 - (1.015 * ($numWords / 1)) - (84.6 * ($syllables / max($numWords, 1)));
        $level = 'Mudah';
        if ($avgWordLen > 7) $level = 'Sulit';
        elseif ($avgWordLen > 5) $level = 'Sedang';
        return [
            'jumlah_kata' => $numWords,
            'rata_huruf_per_kata' => round($avgWordLen, 1),
            'suku_kata_total' => $syllables,
            'tingkat' => $level,
            'skor_keterbacaan' => round($score, 1)
        ];
    }

    private function countSyllables($word) {
        $word = strtolower(trim($word));
        return preg_match_all('/[aiueo]/', $word, $m);
    }

    // ============= PERBAIKAN UTAMA DI SINI =============
    private function semanticAnalysis($words) {
        $subject = null; $object = null; $verb = null;
        
        // Cari kata kerja, kata benda, dan objek
        foreach ($words as $w) {
            $clean = strtolower($w);
            // Cari kata kerja pertama
            if (in_array($clean, $this->kataKerja) && !$verb) {
                $verb = $w;
            }
            // Cari kata benda untuk subjek (sebelum verb) atau objek (setelah verb)
            elseif (in_array($clean, $this->kataBenda)) {
                if (!$verb) {
                    // Jika belum ada verb, anggap ini subjek
                    if (!$subject) $subject = $w;
                } else {
                    // Jika sudah ada verb, anggap ini objek
                    if (!$object) $object = $w;
                }
            }
        }

        // Jika subjek tidak ditemukan, ambil kata pertama yang bukan kata kerja dan bukan preposisi
        if (!$subject && count($words) > 0) {
            foreach ($words as $w) {
                $clean = strtolower($w);
                if (!in_array($clean, $this->kataKerja) && !in_array($clean, $this->preposisi)) {
                    $subject = $w;
                    break;
                }
            }
        }

        // Jika masih tidak ada subjek, gunakan kata pertama
        if (!$subject && count($words) > 0) {
            $subject = $words[0];
        }

        // Jika verb ditemukan tapi objek tidak, coba cari kata setelah verb yang bukan preposisi
        if ($verb && !$object) {
            $verbIndex = -1;
            foreach ($words as $i => $w) {
                if (strtolower($w) == strtolower($verb)) {
                    $verbIndex = $i;
                    break;
                }
            }
            if ($verbIndex !== -1 && $verbIndex < count($words) - 1) {
                $next = $words[$verbIndex + 1];
                $clean = strtolower($next);
                if (!in_array($clean, $this->preposisi) && !in_array($clean, $this->kataKerja)) {
                    $object = $next;
                }
            }
        }

        return [
            'pelaku' => $subject ? "$subject (subjek)" : 'Tidak terdeteksi',
            'tindakan' => $verb ? "$verb (predikat)" : 'Tidak terdeteksi',
            'sasaran' => $object ? "$object (objek)" : 'Tidak terdeteksi'
        ];
    }

    private function styleSuggestions($sentence, $words) {
        $suggestions = [];
        if (strlen($sentence) > 150) {
            $suggestions[] = 'Kalimat terlalu panjang. Pecah menjadi beberapa kalimat pendek.';
        }
        $avgLen = strlen(str_replace(' ', '', $sentence)) / max(count($words), 1);
        if ($avgLen > 8) {
            $suggestions[] = 'Rata-rata kata terlalu panjang. Gunakan kata yang lebih pendek.';
        }
        if (count($words) < 3) {
            $suggestions[] = 'Kalimat terlalu pendek. Tambahkan informasi untuk memperjelas.';
        }
        $hasConj = false;
        foreach ($this->konjungsi as $c) {
            if (strpos(strtolower($sentence), ' ' . $c . ' ') !== false) { $hasConj = true; break; }
        }
        if (!$hasConj && count($words) > 10) {
            $suggestions[] = 'Kalimat panjang tanpa kata sambung. Gunakan konjungsi untuk menghubungkan ide.';
        }
        return $suggestions;
    }
}
?>
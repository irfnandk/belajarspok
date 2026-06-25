<?php
class SentimentAnalyzer {
    private $positif = [
        'suka','senang','bagus','baik','indah','mudah','mengerti','paham',
        'semangat','hebat','luar biasa','sempurna','berhasil','cerdas','pintar',
        'rajin','giat','asyik','menyenangkan','seru','mantap','bangga','gembira',
        'tenang','nyaman','sejahtera','ceria','optimis','bersemangat'
    ];
    
    private $negatif = [
        'tidak suka','benci','buruk','jelek','susah','sulit','bosan','membosankan',
        'stress','pusing','lelah','malas','gagal','bodoh','dungu','ngeri',
        'menakutkan','sedih','marah','kecewa','putus asa','kesal','jengkel',
        'tertekan','cemas','takut','khawatir','patah semangat'
    ];

    public function getSentimentLabel($text) {
        $text = strtolower($text);
        $score = 0;

        foreach ($this->positif as $word) {
            if (strpos($text, $word) !== false) {
                $score++;
            }
        }

        foreach ($this->negatif as $word) {
            if (strpos($text, $word) !== false) {
                $score--;
            }
        }

        if ($score > 0) return 'positif';
        if ($score < 0) return 'negatif';
        return 'netral';
    }
}
?>
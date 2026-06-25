<?php
require_once 'sentence_parser.php';

class GrammarChecker {
    private $parser;

    public function __construct() {
        $this->parser = new SentenceParser();
    }

    public function check($sentence) {
        $parsed = $this->parser->parse($sentence);
        $issues = [];

        if ($parsed['predicate'] === null) {
            $issues[] = ['type' => 'no_predicate', 'message' => 'Tidak ada predikat.', 'suggestion' => 'Tambahkan kata kerja.'];
        }
        if ($parsed['subject'] === null) {
            $issues[] = ['type' => 'no_subject', 'message' => 'Tidak ada subjek jelas.', 'suggestion' => 'Tambahkan subjek sebelum predikat.'];
        }
        $order = $this->parser->correctOrder($sentence);
        if (!$order['is_correct']) {
            $issues[] = ['type' => 'wrong_order', 'message' => 'Urutan kurang tepat.', 'suggestion' => 'Susunan yang benar: ' . $order['corrected']];
        }
        if (!preg_match('/^[A-Z]/', $sentence)) {
            $issues[] = ['type' => 'capitalization', 'message' => 'Harus diawali huruf kapital.', 'suggestion' => 'Kapitalkan huruf pertama.'];
        }
        if (!preg_match('/[.!?]$/', $sentence)) {
            $issues[] = ['type' => 'no_punctuation', 'message' => 'Tidak diakhiri tanda baca.', 'suggestion' => 'Tambahkan titik, tanya, atau seru.'];
        }

        return ['sentence' => $sentence, 'is_valid' => empty($issues), 'issues' => $issues, 'parsed' => $parsed];
    }
}
?>
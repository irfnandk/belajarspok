<?php
class WordValidator {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function validate($sentence) {
        $words = explode(' ', trim($sentence));
        $result = ['original' => $sentence, 'words' => [], 'non_standard' => [], 'suggestions' => []];
        foreach ($words as $word) {
            $clean = preg_replace('/[.,!?;:"]/', '', $word);
            $isBaku = $this->checkStandard($clean);
            $result['words'][] = ['word' => $word, 'is_standard' => $isBaku, 'suggestion' => $isBaku ? null : $this->getSuggestion($clean)];
            if (!$isBaku) {
                $result['non_standard'][] = $word;
                $sug = $this->getSuggestion($clean);
                if ($sug) $result['suggestions'][$word] = $sug;
            }
        }
        return $result;
    }

    private function checkStandard($word) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM kata_baku WHERE kata_tidak_baku = ?");
        $stmt->execute([strtolower($word)]);
        return $stmt->fetchColumn() == 0;
    }

    private function getSuggestion($word) {
        $stmt = $this->db->prepare("SELECT kata_baku FROM kata_baku WHERE kata_tidak_baku = ?");
        $stmt->execute([strtolower($word)]);
        return $stmt->fetchColumn();
    }

    public function correctSentence($sentence) {
        $words = explode(' ', trim($sentence));
        $corrected = [];
        foreach ($words as $word) {
            $clean = preg_replace('/[.,!?;:"]/', '', $word);
            $sug = $this->getSuggestion($clean);
            if ($sug) {
                $punct = '';
                if (preg_match('/[.,!?;:"]$/', $word, $m)) $punct = $m[0];
                $corrected[] = $sug . $punct;
            } else {
                $corrected[] = $word;
            }
        }
        return implode(' ', $corrected);
    }
}
?>
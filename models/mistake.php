<?php
class MistakeModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save($userId, $sentence, $parsed) {
        $type = 'unknown';
        if ($parsed['error']) {
            if (strpos($parsed['error'], 'predikat') !== false) $type = 'no_predicate';
            else $type = 'parsing_error';
        } else {
            if ($parsed['subject'] === null) $type = 'no_subject';
            else if ($parsed['predicate'] === null) $type = 'no_predicate';
        }

        $stmt = $this->db->prepare("INSERT INTO mistakes (user_id, sentence, mistake_type, correct_sentence, date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$userId, $sentence, $type, null]);
    }
}
?>
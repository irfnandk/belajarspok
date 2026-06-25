<?php
class ScoreModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function save($userId, $type, $score, $total) {
        $stmt = $this->db->prepare("INSERT INTO scores (user_id, quiz_type, score, total_questions, date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$userId, $type, $score, $total]);
    }

    public function getHistory($userId) {
        $stmt = $this->db->prepare("SELECT * FROM scores WHERE user_id = ? ORDER BY date DESC LIMIT 10");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
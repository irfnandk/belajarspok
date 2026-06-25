<?php
require_once __DIR__ . '/../models/score.php';
require_once __DIR__ . '/../models/mistake.php';

class ReportController {
    private $db;
    private $scoreModel;
    private $mistakeModel;

    public function __construct($db) {
        $this->db = $db;
        $this->scoreModel = new ScoreModel($db);
        $this->mistakeModel = new MistakeModel($db);
    }

    public function getReport($userId) {
        $scores = $this->scoreModel->getHistory($userId);

        $stmt = $this->db->prepare("SELECT mistake_type, COUNT(*) as count FROM mistakes WHERE user_id = ? GROUP BY mistake_type ORDER BY count DESC");
        $stmt->execute([$userId]);
        $mistakes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = $this->db->prepare("SELECT AVG(score) as avg_score, COUNT(*) as total_quizzes FROM scores WHERE user_id = ?");
        $stmt->execute([$userId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->db->prepare("SELECT level FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $level = $stmt->fetchColumn();

        return [
            'level' => $level,
            'stats' => $stats,
            'scores' => $scores,
            'common_mistakes' => $mistakes
        ];
    }
}
?>
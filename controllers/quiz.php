<?php
require_once __DIR__ . '/../models/score.php';
require_once __DIR__ . '/../models/mistake.php';

class QuizController {
    private $db;
    private $scoreModel;
    private $mistakeModel;

    public function __construct($db) {
        $this->db = $db;
        $this->scoreModel = new ScoreModel($db);
        $this->mistakeModel = new MistakeModel($db);
    }

    public function getAdaptiveQuiz($userId) {
        // Ambil level user
        $stmt = $this->db->prepare("SELECT level FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $level = $user['level'] ?? 1;

        // Ambil kesalahan terbanyak user
        $stmt = $this->db->prepare("SELECT mistake_type, COUNT(*) as count FROM mistakes WHERE user_id = ? GROUP BY mistake_type ORDER BY count DESC LIMIT 1");
        $stmt->execute([$userId]);
        $common = $stmt->fetch(PDO::FETCH_ASSOC);

        // Tentukan kategori berdasarkan kesalahan
        $category = 'spok';
        $map = [
            'no_predicate' => 'spok',
            'no_subject' => 'spok',
            'wrong_order' => 'spok',
            'capitalization' => 'jenis',
        ];
        if ($common && isset($map[$common['mistake_type']])) {
            $category = $map[$common['mistake_type']];
        }

        // Ambil soal sesuai level dan kategori, acak, batasi 10
        $stmt = $this->db->prepare("SELECT * FROM quizzes WHERE category = ? AND level <= ? ORDER BY RAND() LIMIT 10");
        $stmt->execute([$category, $level]);
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Jika kurang dari 5 soal, ambil dari kategori lain
        if (count($questions) < 5) {
            $stmt = $this->db->prepare("SELECT * FROM quizzes WHERE level <= ? ORDER BY RAND() LIMIT 10");
            $stmt->execute([$level]);
            $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return [
            'level' => $level,
            'category' => $category,
            'questions' => $questions
        ];
    }

    public function submitQuiz($userId, $answers) {
        $correct = 0;
        $total = count($answers);

        foreach ($answers as $questionId => $answer) {
            $stmt = $this->db->prepare("SELECT correct_answer FROM quizzes WHERE id = ?");
            $stmt->execute([$questionId]);
            $correctAnswer = $stmt->fetchColumn();
            if ($answer == $correctAnswer) {
                $correct++;
            }
        }

        // Simpan skor
        $this->scoreModel->save($userId, 'adaptive', $correct, $total);

        // Update level jika skor >= 70% (lebih rendah agar progres lebih cepat)
        $percentage = ($correct / max($total, 1)) * 100;
        if ($percentage >= 70) {
            $stmt = $this->db->prepare("UPDATE users SET level = level + 1 WHERE id = ?");
            $stmt->execute([$userId]);
            $levelUp = true;
        } else {
            $levelUp = false;
        }

        return [
            'correct' => $correct,
            'total' => $total,
            'percentage' => $percentage,
            'level_up' => $levelUp
        ];
    }
}
?>
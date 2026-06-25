<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/auth.php';
require_once 'controllers/sentence.php';
require_once 'controllers/quiz.php';
require_once 'controllers/report.php';

$auth = new AuthController($pdo);
$sentenceCtrl = new SentenceController($pdo);
$quizCtrl = new QuizController($pdo);
$reportCtrl = new ReportController($pdo);

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'view';

ob_start();

if ($page == 'auth') {
    if ($action == 'login' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $auth->login($_POST['username'], $_POST['password']);
        header('Location: index.php');
        exit;
    } elseif ($action == 'register' && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $auth->register($_POST['username'], $_POST['password']);
        header('Location: index.php?page=auth&action=login');
        exit;
    } elseif ($action == 'logout') {
        $auth->logout();
        header('Location: index.php');
        exit;
    } else {
        include 'views/login.php';
    }
} elseif ($page == 'analyze') {
    $result = null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sentence'])) {
        $result = $sentenceCtrl->analyze($_POST['sentence']);
    }
    include 'views/analyze.php';
} elseif ($page == 'quiz') {
    $questions = [];
    $score = null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answers'])) {
        if (isset($_SESSION['user_id'])) {
            $score = $quizCtrl->submitQuiz($_SESSION['user_id'], $_POST['answers']);
        } else {
            header('Location: index.php?page=auth&action=login');
            exit;
        }
    } else {
        if (isset($_SESSION['user_id'])) {
            $data = $quizCtrl->getAdaptiveQuiz($_SESSION['user_id']);
        } else {
            $data = $quizCtrl->getAdaptiveQuiz(1);
        }
        $questions = $data['questions'];
    }
    include 'views/quiz.php';
} elseif ($page == 'report') {
    if (isset($_SESSION['user_id'])) {
        $report = $reportCtrl->getReport($_SESSION['user_id']);
    } else {
        $report = null;
    }
    include 'views/report.php';
} else {
    include 'views/home.php';
}

$content = ob_get_clean();
include 'views/layout/header.php';
?>
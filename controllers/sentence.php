<?php
require_once __DIR__ . '/../libraries/nlp/sentence_parser.php';
require_once __DIR__ . '/../libraries/nlp/word_validator.php';
require_once __DIR__ . '/../libraries/nlp/grammar_checker.php';
require_once __DIR__ . '/../libraries/nlp/sentence_analyzer.php';
require_once __DIR__ . '/../libraries/nlp/sentiment_analyzer.php';
require_once __DIR__ . '/../models/mistake.php';

class SentenceController {
    private $db;
    private $parser;
    private $validator;
    private $checker;
    private $analyzer;
    private $sentiment;
    private $mistakeModel;

    public function __construct($db) {
        $this->db = $db;
        $this->parser = new SentenceParser();
        $this->validator = new WordValidator($db);
        $this->checker = new GrammarChecker();
        $this->analyzer = new SentenceAnalyzer();
        $this->sentiment = new SentimentAnalyzer();
        $this->mistakeModel = new MistakeModel($db);
    }

    public function analyze($sentence) {
        $parsed = $this->parser->parse($sentence);
        $grammar = $this->checker->check($sentence);
        $wordCheck = $this->validator->validate($sentence);
        $extra = $this->analyzer->analyze($sentence);
        $sentiment = $this->sentiment->getSentimentLabel($sentence);

        if (isset($_SESSION['user_id'])) {
            $this->mistakeModel->save($_SESSION['user_id'], $sentence, $parsed);
        }

        return [
            'sentence' => $sentence,
            'spok' => $parsed,
            'grammar' => $grammar,
            'words' => $wordCheck,
            'extra' => $extra,
            'sentiment' => $sentiment
        ];
    }

    public function correct($sentence) {
        $orderResult = $this->parser->correctOrder($sentence);
        $wordResult = $this->validator->correctSentence($sentence);
        return [
            'original' => $sentence,
            'corrected_order' => $orderResult['corrected'],
            'corrected_words' => $wordResult,
            'final' => $this->validator->correctSentence($orderResult['corrected'])
        ];
    }

    public function checkWords($sentence) {
        return $this->validator->validate($sentence);
    }
}
?>
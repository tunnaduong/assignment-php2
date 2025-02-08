<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\User;

class HomeController extends BaseController
{
    public function home()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ./login');
        }

        if ($_SESSION['user']->role == 'admin') {
            $user = new User();
            $users = $user->getAllUsers();
            $quiz = new Quiz();
            $quizzes = $quiz->getNumberOfQuizzes();
            $attempts = $quiz->getNumberOfAttempts();
            return $this->render('pages.admin.index', compact('users', 'quizzes', 'attempts'));
        }

        $quiz = new Quiz();
        $quizzes = $quiz->getAllQuiz();

        foreach ($quizzes as $quizItem) {
            $quizItem->user_attempted = $quiz->hasUserAttempted($_SESSION['user']->id, $quizItem->id);
        }

        return $this->render('pages.home.index', [
            'quizzes' => $quizzes,
        ]);
    }

    public function storeQuizAnswer($quizId, $questionIndex)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']->id;
            $selectedAnswerId = $_POST['selected_answer'];
            $questionId = $_POST['question_id'];
            $totalQuestions = $_POST['total_questions'];
            $selectedAnswers = $_POST['selected_answers'] ?? [];

            $quiz = new Quiz();
            $quiz->saveUserResponse($userId, $quizId, $questionId, $selectedAnswerId);

            $selectedAnswers[$questionId] = $selectedAnswerId;

            // If it's the last question, go to results page
            if ($questionIndex >= $totalQuestions) {
                header('Location: /quiz/' . $quizId . '/result');
                exit();
            }

            // Otherwise, go to next question
            header('Location: /quiz/' . $quizId . '/' . $questionIndex . '?' . http_build_query(['selected_answers' => $selectedAnswers]));
            exit();
        }

        $quiz = new Quiz();
        $quizData = $quiz->getQuiz($quizId);
        $questions = $quiz->getQuizQuestions($quizId);

        $currentQuestion = $questions[$questionIndex];
        $answers = $quiz->getQuizAnswers($currentQuestion->id);
        $selectedAnswers = $_GET['selected_answers'] ?? [];

        return $this->render('pages.quiz.index', [
            'quiz' => $quizData,
            'question' => $currentQuestion,
            'answers' => $answers,
            'questionIndex' => $questionIndex,
            'totalQuestions' => count($questions),
            'selectedAnswers' => $selectedAnswers,
        ]);
    }

    public function showQuizResult($quizId)
    {
        $userId = $_SESSION['user']->id;
        $quiz = new Quiz();

        // Get total questions
        $totalQuestions = $quiz->getTotalQuestions($quizId);

        // Get correct answers by the user
        $correctAnswers = $quiz->calculateUserScore($userId, $quizId);

        // Calculate score percentage
        $scorePercentage = ($totalQuestions > 0) ? ($correctAnswers / $totalQuestions) * 100 : 0;

        // Save user attempt
        $quiz->saveUserAttempt($userId, $quizId, $scorePercentage);

        $quiz->deleteAllResponse();

        return $this->render('pages.quiz.result', [
            'quiz' => $quiz->getQuiz($quizId),
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'scorePercentage' => round($scorePercentage, 2)
        ]);
    }
}

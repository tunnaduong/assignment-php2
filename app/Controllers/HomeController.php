<?php

namespace App\Controllers;

use App\Models\Quiz;

class HomeController extends BaseController
{
    public function home()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ./login');
        }

        if ($_SESSION['user']->role == 'admin') {
            return $this->render('pages.admin.index');
        }

        return $this->render('pages.home.index');
    }

    public function quiz($quizId, $questionIndex = 0)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: ./login');
            exit();
        }

        $quiz = new Quiz();
        $quizData = $quiz->getQuiz($quizId);
        $questions = $quiz->getQuizQuestions($quizId);

        $currentQuestion = $questions[$questionIndex];
        $answers = $quiz->getQuizAnswers($currentQuestion->id);

        return $this->render('pages.quiz.index', [
            'quiz' => $quizData,
            'question' => $currentQuestion,
            'answers' => $answers,
            'questionIndex' => $questionIndex,
            'totalQuestions' => count($questions),
        ]);
    }
}

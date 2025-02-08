<?php

namespace App\Controllers;

use App\Models\Quiz;

class AdminController extends BaseController
{
    public function manageQuiz()
    {
        $quiz = new Quiz();
        $quizzes = $quiz->getAllQuiz();
        return $this->render('pages.admin.quiz', compact('quizzes'));
    }
}

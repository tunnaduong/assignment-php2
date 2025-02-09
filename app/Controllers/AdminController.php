<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\User;

class AdminController extends BaseController
{
    public function manageQuiz()
    {
        $quiz = new Quiz();
        $quizzes = $quiz->getAllQuiz();
        foreach ($quizzes as $quizItem) {
            $quizItem->total_questions = $quiz->getTotalQuestions($quizItem->id);
        }
        return $this->render('pages.admin.quiz', compact('quizzes'));
    }

    public function create()
    {
        $this->render('pages.admin.createQuiz');
    }

    public function createQuiz()
    {
        $quiz = new Quiz();
        $quiz->createQuiz($_POST);
        header('Location: /manage/quizzes');
    }

    public function editQuiz($quizId)
    {
        $quiz1 = new Quiz();
        $quiz = $quiz1->getQuiz($quizId);
        $quiz->questions = $quiz1->getQuizQuestions($quizId);
        foreach ($quiz->questions as $question) {
            $question->answers = $quiz1->getQuizAnswers($question->id);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quiz = new Quiz();
            $quiz->updateQuiz($quizId, [
                'questions' => $_POST['questions'] ?? [],
                'answers' => $_POST['answers'],
                'correct_answer' => $_POST['correct_answer']
            ]);
            echo "<pre>";
            var_dump([
                'questions' => $_POST['questions'] ?? [],
                'answers' => $_POST['answers'],
                'correct_answer' => $_POST['correct_answer']
            ]);
            echo "</pre>";
            exit();
            header('Location: /manage/quizzes');
        }

        return $this->render('pages.admin.editQuiz', compact('quiz'));
    }

    public function deleteQuiz($quizId)
    {
        $quiz = new Quiz();
        $quiz->deleteQuiz($quizId);
        header('Location: /manage/quizzes');
    }

    public function manageUsers()
    {
        $user = new User();
        $users = $user->getAllUsers();
        return $this->render('pages.admin.user', compact('users'));
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return $this->render('pages.admin.createUser');
        }
        $user = new User();
        $user->register($_POST['full_name'], $_POST['email'], $_POST['password'], $_POST['role'] ?? "user");
        header('Location: /manage/users');
    }

    public function deleteUser($userId)
    {
        $user = new User();
        $user->deleteUser($userId);
        header('Location: /manage/users');
    }

    public function editUser($userId)
    {
        $user = new User();
        $user = $user->getUser($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->updateUser($userId, $_POST);
            header('Location: /manage/users');
        }

        return $this->render('pages.admin.editUser', compact('user'));
    }
}

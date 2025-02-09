<?php

namespace App\Controllers;

use App\Models\Quiz;
use App\Models\User;

class AdminController extends BaseController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
            header('Location: ' . route(''));
            exit();
        }
    }

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
        header('Location: ' . route('manage/quizzes'));
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
            $questions = array_filter($_POST['questions'], function ($question) {
                return !empty(trim($question));
            });

            $_POST['answers'] = array_map(function ($answers) {
                return array_filter($answers, function ($answer) {
                    return !empty(trim($answer));
                });
            }, $_POST['answers']);

            $_POST['answers'] = array_filter($_POST['answers'], function ($answers) {
                return !empty($answers);
            });

            if (!empty($questions)) {
                $quiz = new Quiz();
                $quiz->updateQuiz($quizId, [
                    'questions' => $questions,
                    'answers' => $_POST['answers'],
                    'correct_answer' => $_POST['correct_answer'],
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'duration' => $_POST['duration']
                ]);
                // echo "<pre>";
                // var_dump([
                //     'questions' => $_POST['questions'] ?? [],
                //     'answers' => $_POST['answers'],
                //     'correct_answer' => $_POST['correct_answer']
                // ]);
                // echo "</pre>";
                header('Location: ' . route('manage/quizzes'));
                exit();
            }
        }

        return $this->render('pages.admin.editQuiz', compact('quiz'));
    }

    public function deleteQuiz($quizId)
    {
        $quiz = new Quiz();
        $quiz->deleteQuiz($quizId);
        header('Location: ' . route('manage/quizzes'));
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
        header('Location: ' . route('manage/users'));
    }

    public function deleteUser($userId)
    {
        $user = new User();
        $user->deleteUser($userId);
        header('Location: ' . route('manage/users'));
    }

    public function editUser($userId)
    {
        $user = new User();
        $user = $user->getUser($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            $user->updateUser($userId, $_POST);
            header('Location: ' . route('manage/users'));
        }

        return $this->render('pages.admin.editUser', compact('user'));
    }
}

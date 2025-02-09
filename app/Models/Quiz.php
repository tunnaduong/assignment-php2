<?php

namespace App\Models;

class Quiz extends BaseModel
{
    public function getQuiz($quizId)
    {
        $this->setQuery("SELECT * FROM quizzes WHERE id = ?");
        return $this->loadRow([$quizId]);
    }

    public function getQuizQuestions($quizId)
    {
        $this->setQuery('SELECT * FROM questions WHERE quiz_id = ?');
        return $this->loadAllRows([$quizId]);
    }

    public function getQuizAnswers($questionId)
    {
        $this->setQuery('SELECT * FROM answers WHERE question_id = ?');
        return $this->loadAllRows([$questionId]);
    }

    public function getAllQuiz()
    {
        $this->setQuery('SELECT * FROM quizzes');
        return $this->loadAllRows();
    }

    public function calculateQuizResult($userId, $quizId)
    {
        $this->setQuery("
        SELECT COUNT(*) AS total_questions 
        FROM questions 
        WHERE quiz_id = ?
    ");
        $totalQuestions = $this->loadRow([$quizId])->total_questions;

        if ($totalQuestions == 0) {
            return ['score' => 0, 'percentage' => 0, 'correct_answers' => 0, 'total_questions' => 0];
        }

        $this->setQuery("
        SELECT COUNT(*) AS correct_answers 
        FROM user_responses ur
        JOIN answers a ON ur.selected_answer_id = a.id
        WHERE ur.user_id = ? AND ur.quiz_id = ? AND a.is_correct = 1
    ");
        $correctAnswers = $this->loadRow([$userId, $quizId])->correct_answers;

        $scorePercentage = ($correctAnswers / $totalQuestions) * 100;

        return [
            'score' => $correctAnswers,
            'percentage' => round($scorePercentage, 2),
            'correct_answers' => $correctAnswers,
            'total_questions' => $totalQuestions
        ];
    }

    public function submitQuiz($userId, $quizId, $responses)
    {
        foreach ($responses as $questionId => $selectedAnswerId) {
            $this->setQuery("
                INSERT INTO user_responses (user_id, quiz_id, question_id, selected_answer_id)
                VALUES (?, ?, ?, ?)
            ");
            $this->execute([$userId, $quizId, $questionId, $selectedAnswerId]);
        }

        return true;
    }

    public function saveUserResponse($userId, $quizId, $questionId, $selectedAnswerId)
    {
        $this->setQuery("
            INSERT INTO user_responses (user_id, quiz_id, question_id, selected_answer_id)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE selected_answer_id = VALUES(selected_answer_id)
        ");
        $this->execute([$userId, $quizId, $questionId, $selectedAnswerId]);

        return true;
    }

    // Get total number of questions in the quiz
    public function getTotalQuestions($quizId)
    {
        $this->setQuery("SELECT COUNT(*) FROM questions WHERE quiz_id = ?");
        return $this->loadRecord([$quizId]);
    }

    // Get the number of correct answers submitted by the user
    public function calculateUserScore($userId, $quizId)
    {
        $this->setQuery("
        SELECT COUNT(DISTINCT ur.question_id) FROM user_responses ur
        JOIN answers a ON ur.selected_answer_id = a.id
        WHERE ur.user_id = ? AND ur.quiz_id = ? AND a.is_correct = 1
    ");
        return $this->loadRecord([$userId, $quizId]);
    }

    public function deleteAllResponse()
    {
        $this->setQuery("DELETE FROM user_responses");
        return $this->execute();
    }

    public function saveUserAttempt($userId, $quizId, $score)
    {
        $this->setQuery("
            INSERT INTO user_attempts (user_id, quiz_id, score)
            VALUES (?, ?, ?)
        ");
        $this->execute([$userId, $quizId, $score]);
    }

    public function hasUserAttempted($userId, $quizId)
    {
        $this->setQuery("SELECT COUNT(*) as count FROM user_attempts WHERE user_id = ? AND quiz_id = ?");
        return $this->loadRow([$userId, $quizId])->count > 0;
    }

    public function getNumberOfQuizzes()
    {
        $this->setQuery("SELECT COUNT(*) as count FROM quizzes");
        return $this->loadRow()->count;
    }

    public function getNumberOfAttempts()
    {
        $this->setQuery("SELECT COUNT(*) as count FROM user_attempts");
        return $this->loadRow()->count;
    }

    public function createQuiz($data)
    {
        $this->setQuery("INSERT INTO quizzes (title, description) VALUES (?, ?)");
        return $this->execute([$data['title'], $data['description']]);
    }

    public function deleteQuiz($quizId)
    {
        $this->setQuery("DELETE FROM quizzes WHERE id = ?");
        return $this->execute([$quizId]);
    }

    public function updateQuiz($quizId, $data)
    {
        // update quiz title and description
        $this->setQuery("UPDATE quizzes SET title = ?, description = ?, duration = ? WHERE id = ?");
        $this->execute([$data['title'], $data['description'], $data['duration'], $quizId]);

        // Delete existing questions and answers for the quiz
        $this->setQuery("DELETE FROM questions WHERE quiz_id = ?");
        $this->execute([$quizId]);

        $this->setQuery("DELETE FROM answers WHERE question_id IN (SELECT id FROM questions WHERE quiz_id = ?)");
        $this->execute([$quizId]);

        // Insert new questions and answers
        foreach ($data['questions'] as $questionIndex => $questionText) {
            // Insert the question
            $this->setQuery("INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)");
            $this->execute([$quizId, $questionText]);
            $questionId = $this->getLastId();

            // Insert the answers for the question
            foreach ($data['answers'][$questionIndex] as $answerIndex => $answerText) {
                $isCorrect = ($answerIndex == $data['correct_answer'][$questionIndex] ? 1 : 0);
                $this->setQuery("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                $this->execute([$questionId, $answerText, $isCorrect]);
            }
        }
    }
}

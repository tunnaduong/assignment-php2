<?php

use Phroute\Phroute\RouteCollector;

$url = !isset($_GET['url']) ? "/" : $_GET['url'];
try {
    $router = new RouteCollector();


    // khu vực cần quan tâm -----------
    // bắt đầu định nghĩa ra các đường dẫn
    $router->get('/', [App\Controllers\HomeController::class, 'home']);

    $router->any("/login", [App\Controllers\AuthController::class, 'login']);

    $router->get('/logout', [App\Controllers\AuthController::class, 'logout']);

    $router->get('/quiz/{quizId}/start', [App\Controllers\HomeController::class, 'startQuiz']);

    $router->any('/quiz/{quizId}/result', [App\Controllers\HomeController::class, 'showQuizResult']);

    $router->any('/quiz/{quizId}/{questionIndex}', [App\Controllers\HomeController::class, 'storeQuizAnswer']);

    $router->get('/reset-password', [App\Controllers\AuthController::class, 'showResetPassword']);
    $router->post('/reset-password', [App\Controllers\AuthController::class, 'resetPassword']);

    $router->get('/manage/users', [App\Controllers\AdminController::class, 'manageUsers']);

    $router->any('/manage/users/create', [App\Controllers\AdminController::class, 'createUser']);

    $router->post('/manage/users/delete/{userId}', [App\Controllers\AdminController::class, 'deleteUser']);

    $router->any('/manage/users/edit/{userId}', [App\Controllers\AdminController::class, 'editUser']);

    $router->get('/manage/quizzes', [App\Controllers\AdminController::class, 'manageQuiz']);

    $router->get('/manage/quizzes/create', [App\Controllers\AdminController::class, 'create']);

    $router->post('/manage/quizzes/create', [App\Controllers\AdminController::class, 'createQuiz']);

    $router->post('/manage/quizzes/delete/{quizId}', [App\Controllers\AdminController::class, 'deleteQuiz']);

    $router->any('/manage/quizzes/edit/{quizId}', [App\Controllers\AdminController::class, 'editQuiz']);

    // khu vực cần quan tâm -----------
    //$router->get('test', [App\Controllers\ProductController::class, 'index']);

    # NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
    $dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $url);

    // Print out the value returned from the dispatched function
    echo $response;
} catch (Exception $e) {
    var_dump($e->getMessage());
    die;
}

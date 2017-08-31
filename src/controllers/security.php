<?php
namespace app\src\controllers\security;
use app\core;
use function app\core\renderView;
use function app\core\redirect;
use function app\core\addFlash;
use app\src\models\User;


function login() {
    if (!isset($_POST['username']) || !isset($_POST['password'])) {
        core\addFlash('danger', 'Not enough parameters');
        core\redirect('main_page');
    }
    if (!($user = loadUserByUsername($_POST['username']))) {
        core\addFlash('danger', 'Username or password are incorrect');
        core\redirect('main_page');
    }
    if (password_verify($_POST['password'], $user['password'])) {
        core\addFlash('danger', 'Username or password are incorrect');
        core\redirect('main_page');
    }

    core\persistUser($user);

    core\addFlash('success', sprintf('Hi, %s!', $user['username']));

    core\redirect('main_page');
}

function logout() {
    core\clearUser();
    core\redirect('main_page');
}

function loadUserByUsername($username) {
    global $app;
    $result = User::select('*')->where('users.username', '=', $_POST['username'])->get()->toArray();
    $app['user'] = $result;
    return current(array_filter($app['user'], function($user) use($username) {
        return $user['username'] == $username;
    }));
}

function index() {
    return renderView(['template.php', 'users/registration.php']);
}

function addUser() {
    $user = User::select('*')->where('users.username', '=', $_POST['userName'])->get()->toArray();

    if ($_POST['passWord'] === $_POST['confirmPassWord'] && $_POST['userName'] !== $user[0]['username']) {
        User::insert(['username' => $_POST['userName'], 'password' => password_hash($_POST['passWord'], PASSWORD_DEFAULT)]);

        addFlash('success', 'You are successfully registered, please log in!');
        redirect('main_page');
    } else {
        addFlash('warning', 'Please enter another login, or check whether the password and its confirmation are equal!');
        redirect('registration');
    }
}

